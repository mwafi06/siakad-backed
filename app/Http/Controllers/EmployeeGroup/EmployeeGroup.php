<?php
namespace App\Http\Controllers\EmployeeGroup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeGroup extends Controller
{
    public function __construct()
    {
        parent::__construct();

        /* set default mod Alias */
        $this->middleware(function ($request, $next) {
            $this->viewData['modAlias'] = 'employee-group';
            return $next($request);
        });
    }

    /**
     * page employee group
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        /*
         * get all GET data
         */
        $allGet = (object)$request->all();

        /*
         * get employee group data
         */
        $query = employeeRepository()
            ->employeeGroup()
            ->selectRaw('*,(SELECT COUNT(1) FROM employee where employee.guid = employee_group.guid) as total_user');

        if ($request->has('q'))
        {
            $query->where('name','like','%'.$allGet->q.'%');
        }

        $employeeGroup = $query->paginate($this->limit)
            ->appends($request->except('page'));

        /*
         * set view data
         */
        $this->viewData['page'] = 'employee group';
        $this->viewData['content'] = 'employee-group.content';
        $this->viewData['data'] = $employeeGroup;
        $this->viewData['data'] = $employeeGroup;
        $this->viewData['allGet'] = $allGet;

        return view($this->themes,$this->viewData);
    }

    /**
     * page add employee group
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        /*
         * set view data
         */
        $this->viewData['page'] = 'add employee group';
        $this->viewData['content'] = 'employee-group.formAdd';
        $this->viewData['module'] = general()->getModule();

        return view($this->themes,$this->viewData);
    }

    /**
     * save insert employee group
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        /*
         * get all post
         */
        $allPost = (object)$request->all();

        /*
         * define variable
         */
        $callback = redirect(route('employee-group'));
        $referrer = back()->withInput();

        /*
         * set form validation
         */
        $rules = array(
            'name' => 'required',
            'delete' => 'required',
            'edit' => 'required',
            'create' => 'required',
            'view' => 'required'
        );

        $validator = validator();
        $validator = $validator->make($request->all(), $rules);

        if (!$validator->fails())
        {
            /*
             * if validation success
             */

            /*
             * insert data user group
             */
            $insertData = array(
                'name'=>$allPost->name,
                'create'  => implode(',',$allPost->create),
                'update'  => implode(',',$allPost->edit),
                'read'    => implode(',',$allPost->view),
                'delete'  => implode(',',$allPost->delete),
                'created_at' => general()->dateTime,
            );

            employeeRepository()->employeeGroup()->insert($insertData);

            session()->flash('msgSuccess', 'Data Saved!');

            return $callback;
        }
        else
        {
            /*
             * if validation failed
             */
            session()->flash('msgError', $validator->errors()->first());

            return $referrer;
        }
    }

    /**
     * page edit employee group
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id = null)
    {

        if (is_null($id))
        {
            session()->flash('msgError', 'Data Not found!');
            return redirect(route('employee-group'));
        }

        /*
         * get data edited data
         */
        $getData = employeeRepository()
            ->EmployeeGroup()
            ->selectRaw('*,(SELECT COUNT(1) FROM employee where employee.guid = employee_group.guid) as total_user')
            ->where('guid',$id)->get();

        if ($getData->count() == 0)
        {
            session()->flash('msgError', 'Data Not found!');
            return redirect(route('employee-group'));
        }

        $data = $getData->first();

        /*
         * set view data
         */
        $this->viewData['page'] = 'edit employee group';
        $this->viewData['content'] = 'employee-group.formEdit';
        $this->viewData['module'] = general()->getModule();
        $this->viewData['data'] = $data;


        return view($this->themes,$this->viewData);
    }

    /**
     * Update data employee group
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        /*
         * get all post data
         */
        $allPost = (object)$request->all();

        /*
         * define variable
         */
        $callback = route('employee-group');
        $referrer = route('employee-group.edit',$allPost->guid);

        /*
         * set form validation
         */
        $rules = array(
            'guid' => 'required',
            'name' => 'required',
            'delete' => 'required',
            'edit' => 'required',
            'create' => 'required',
            'view' => 'required'
        );

        $validator = validator();
        $validator = $validator->make($request->all(), $rules);

        if (!$validator->fails())
        {
            /*
             * if validation success
             */

            $employeeGroup = employeeRepository()->employeeGroup()->where('guid',$allPost->guid);

            if ($employeeGroup->count() == 0)
            {
                session()->flash('msgError', 'Data Not found!');
                return redirect($referrer);
            }

            /*
             * insert data user group
             */
            $insertData = array(
                'name'=>$allPost->name,
                'create'  => implode(',',$allPost->create),
                'update'  => implode(',',$allPost->edit),
                'read'    => implode(',',$allPost->view),
                'delete'  => implode(',',$allPost->delete),
                'updated_at' => general()->dateTime,
            );

            $employeeGroup->update($insertData);

            session()->flash('msgSuccess', 'Data has been updated!');

            return redirect($callback);
        }
        else
        {
            /*
             * if validation failed
             */
            session()->flash('msgError', $validator->errors()->first());

            return redirect($referrer);
        }
    }

    /**
     * delete data employee group
     *
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id = null)
    {
        if (is_null($id))
        {
            session()->flash('msgError', 'Data Not found!');
            return redirect(route('employee-group'));
        }

        /*
         * check data operator from group
         */
        $check = employeeRepository()->employee()
            ->selectRaw('count(1) as count')
            ->where('guid',$id)->first();

        if($check->count > 0)
        {
            session()->flash('msgError', 'Can\'t Delete Group, Group Already have operator!');
            return redirect(route('employee-group'));
        }

        employeeRepository()->employeeGroup()->find($id)->delete();

        session()->flash('msgSuccess', 'Data Successfully Delete');
        return redirect(route('employee-group'));
    }
}
