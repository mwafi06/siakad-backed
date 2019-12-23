<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Employee extends Controller
{
    public function __construct()
    {
        parent::__construct();

        /* set default mod Alias */
        $this->middleware(function ($request, $next) {
            $this->viewData['modAlias'] = 'employee';
            return $next($request);
        });
    }

    /**
     * page employee
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
         * get employee data
         */
        $query = employeeRepository()->employee()
            ->selectRaw('employee.*,employee_group.name as employee_group_name')
            ->leftJoin('employee_group','employee_group.guid','=','employee.guid');

        if ($request->has('q'))
        {
            $query->where('username','like','%'.$allGet->q.'%')
                ->orWhere('nip','like','%'.$allGet->q.'%')
                ->orWhere('full_name','like','%'.$allGet->q.'%')
                ->orWhere('email','like','%'.$allGet->q.'%')
                ->orWhere('phone','like','%'.$allGet->q.'%');
        }

        $employee = $query->paginate($this->limit)
            ->appends($request->except('page'));
        /*
         * set view data
         */
        $this->viewData['page'] = 'employee';
        $this->viewData['content'] = 'employee.content';
        $this->viewData['data'] = $employee;
        $this->viewData['allGet'] = $allGet;

        return view($this->themes,$this->viewData);
    }

    /**
     * page add employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {

        /*
         * get data employee group
         */
        $employeeGroup =  employeeRepository()->getDropdownEmployeeGroup();

        /*
         * set view data
         */
        $this->viewData['page'] = 'add employee';
        $this->viewData['content'] = 'employee.formAdd';
        $this->viewData['employeeGroup'] = $employeeGroup;

        return view($this->themes,$this->viewData);
    }


    /**
     * function to save data employee
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        /*
         * get all post data
         */
        $allPost = (object)$request->all();

        /*
         * define variable
         */
        $callback = redirect(route('employee'));
        $referrer = back()->withInput();

        /*
         * set form validation
         */
        $rules = array(
            'guid' => 'required',
            'username' => 'required',
            'password' => 'required',
            're_password' => 'required',
            'nip' => 'required',
            'full_name' => 'required',
            'teacher' => 'required'
        );

        $validator = validator();
        $validator = $validator->make($request->all(), $rules);

        if (!$validator->fails())
        {
            /*
             * if validation success
             */

            /*
             * check re password
             */
            if ($allPost->password != $allPost->re_password)
            {
                session()->flash('msgError','Invalid Re Password! Please Make Sure Re Password.');
                return $referrer;
            }

            /*
             * validate nip and username already exist or not
             */
            $check = employeeRepository()
                ->employee()
                ->where('nip',$allPost->nip)
                ->orWhere('username',$allPost->username)
                ->get();

            if ($check->count() > 0)
            {
                $employee = $check->first();
                if ($employee->nip == $allPost->nip)
                {
                    session()->flash('msgError', 'NIP Already registered!');
                }

                if ($employee->username == $allPost->username)
                {
                    session()->flash('msgError', 'username Already registered! please using another username.');
                }

                return $referrer;
            }

            /*
             * set insert data
             */
            $insetData = array(
                'guid'      => $allPost->guid,
                'nip'       => $allPost->nip,
                'full_name' => $allPost->full_name,
                'username'  => $allPost->username,
                'password'  => aes_encrypt($allPost->password),
                'is_teacher'=> $allPost->teacher,
                'created_at'=> general()->dateTime
            );

            if($request->has('email'))
            {
                $insetData['email'] = $allPost->email;
            }

            if($request->has('phone'))
            {
                $insetData['phone'] = $allPost->phone;
            }

            if($request->has('address'))
            {
                $insetData['address'] = $allPost->address;
            }

            if ($request->has('date') && $request->has('month') && $request->has('year'))
            {
                $insetData['date_of_birth'] = Carbon::create($allPost->year,$allPost->month,$allPost->date)->format('Y-m-d');
            }

            employeeRepository()->employee()->insert($insetData);

            session()->flash('msgSuccess','Data has been saved!');
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

    public function edit($id = null)
    {

        if (is_null($id))
        {
            session()->flash('msgError', 'Data Not found!');
            return redirect(route('employee'));
        }

        /*
         * get data edited data
         */
        $getData = employeeRepository()->employee()
            ->where('uid',$id)->get();

        if ($getData->count() == 0)
        {
            session()->flash('msgError', 'Data Not found!');
            return redirect(route('employee'));
        }

        $data = $getData->first();

        /*
         * get data employee group
         */
        $employeeGroup =  employeeRepository()->getDropdownEmployeeGroup();

        /*
         * set view data
         */
        $this->viewData['page'] = 'edit employee';
        $this->viewData['content'] = 'employee.formEdit';
        $this->viewData['data'] = $data;
        $this->viewData['employeeGroup'] = $employeeGroup;

        return view($this->themes,$this->viewData);
    }

    /**
     * function to update employee data
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
        $callback = redirect(route('employee'));
        $referrer = back()->withInput();

        /*
         * set form validation
         */
        $rules = array(
            'uid' => 'required',
            'guid' => 'required',
            'nip' => 'required',
            'full_name' => 'required',
            'teacher' => 'required'
        );

        $validator = validator();
        $validator = $validator->make($request->all(), $rules);

        if (!$validator->fails())
        {
            /*
             * if validation success
             */

            $employee = employeeRepository()->employee()->where('uid',$allPost->uid);

            if ($employee->count() == 0)
            {
                session()->flash('msgError', 'Data Not found!');
                return redirect($referrer);
            }

            /*
             * validate nip and username already exist or not
             */
            $check = employeeRepository()
                ->employee()
                ->where('nip',$allPost->nip)
                ->where('uid','!=',$allPost->uid)
                ->get();

            if ($check->count() > 0)
            {
                session()->flash('msgError', 'NIP Already registered!');
                return $referrer;
            }

            /*
             * set insert data
             */
            $updateData = array(
                'guid'      => $allPost->guid,
                'nip'       => $allPost->nip,
                'full_name' => $allPost->full_name,
                'is_teacher'=> $allPost->teacher,
                'created_at'=> general()->dateTime
            );

            if($request->has('email'))
            {
                $updateData['email'] = $allPost->email;
            }

            if($request->has('phone'))
            {
                $updateData['phone'] = $allPost->phone;
            }

            if($request->has('address'))
            {
                $updateData['address'] = $allPost->address;
            }

            if ($request->has('date') && $request->has('month') && $request->has('year'))
            {
                $updateData['date_of_birth'] = Carbon::create($allPost->year,$allPost->month,$allPost->date)->format('Y-m-d');
            }

            /*
             * check re password
             */
            if ($request->has('password') && $request->has('re_password'))
            {
                if ($allPost->password != $allPost->re_password)
                {
                    session()->flash('msgError','Invalid Re Password! Please Make Sure Re Password.');
                    return $referrer;
                }
            }

            employeeRepository()->employee()->where('uid',$allPost->uid)->update($updateData);

            session()->flash('msgSuccess','Data has been saved!');
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
     * function to delete employee data
     *
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id = null)
    {
        if (is_null($id))
        {
            session()->flash('msgError', 'Data Not found!');
            return redirect(route('employee'));
        }

        /*
         * check data operator from group
         */
        $check = generalRepository()->teacher()
            ->selectRaw('count(1) as count')
            ->where('uid',$id)->first();

        if($check->count > 0)
        {
            session()->flash('msgError', 'Can\'t Delete Employee data, Data is Teacher and Already Have lessons!');
            return redirect(route('employee'));
        }

        employeeRepository()->employee()->find($id)->delete();

        session()->flash('msgSuccess', 'Data Successfully Delete');
        return redirect(route('employee'));
    }
}
