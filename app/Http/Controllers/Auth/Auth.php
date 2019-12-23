<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Auth extends Controller
{
    /**
     * page login
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        /*
         * get all get data
         */
        $allGet = (object)$request->all();

        /*
         * set view data
         */
        $this->viewData['redirect'] = $allGet->redirect ?? false;

        return view('layout.login',$this->viewData);
    }

    public function doLogin(Request $request)
    {
        /*
         * get all post data
         */
        $allPost = (object)$request->all();

        /*
         * define variable
         */
        $callback = isset($allPost->redirect) ? redirect(rawurldecode($allPost->redirect)) : redirect('');
        $referrer = back()->withInput();
        $token_login = general()->random_string('alnum',50);

        /*
         * set form validation
         */
        $rules = array(
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        );

        $validator = validator();
        $validator = $validator->make($request->all(), $rules);

        if (!$validator->fails())
        {
            /*
             * find employee user data for login
             */
            $employee = employeeRepository()->findEmployeeLogin($allPost->username);

            if (!$employee)
            {
                session()->flash('msgError', 'User not found! please check Username/NIP again.');

                return $referrer;
            }

            /*
             * check password user
             */
            $password = aes_decrypt($employee->password);

            if ($password !== $allPost->password)
            {
                session()->flash('msgError', 'Incorrect password! be sure you\'re using the correct password');

                return $referrer;
            }

            if ($employee->pin_login == 'y' && !is_null($employee->pin))
            {
                // todo : make pin login
            }

            /*
             * get employee group
             */
            $employeeGroup = employeeRepository()->getEmployeeGroup('uid',$employee->uid)->first();

            /*
             * get list module
             */
            $module = generalRepository()->getModule()->sortBy('mod_order');

            /*
             * generate session login
             */
            $session = array(
                'is_login' => true,
                'token_login' => $token_login,
                'user' => (object)array(
                    'username' => $employee->username,
                    'nis' => $employee->nis,
                ),
                'role' => $employeeGroup,
                'module' => $module,

            );

            session()->put($session);

            if (isset($allPost->remember))
            {
                /*
                 * update remember token employee
                 */
                employeeRepository()->updateEmployeeRememberToken($employee->uid,$token_login);

                /*
                 * set to cookie user
                 */
                $cookie = cookie()->forever('remember_token',$token_login);
                Cookie::queue($cookie);
            }

            return $callback;

        }
        else
        {
            /*
             * if validation failed
             */

            if ($validator->errors()->first() == 'validation.captcha')
            {
                $msg = 'Invalid Captcha!';
            }
            else
            {
                $msg = $validator->errors()->first();
            }

            session()->flash('msgError', $msg);

            return $referrer;
        }
    }

    /**
     * function to,logout and flash session
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        /*
         * reset session
         */
        session()->flush();

        /*
         * reset cookie
         */
        $cookie = cookie()->forget('remember_token');
        Cookie::queue($cookie);

        return redirect('');
    }
}
