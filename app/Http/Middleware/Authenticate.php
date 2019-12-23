<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class Authenticate
{
    public function handle($request, Closure $next)
    {

        /*
         * if has session logged_in
         */
        if (!$request->session()->has('is_login') || $request->session()->get('is_login') == false)
        {
            if (Cookie::has('remember_token'))
            {
                $cookie = Cookie::get('remember_token');

                $find = employeeRepository()->getEmployee('remember_token',$cookie);

                if ($find->isNotEmpty())
                {
                    $employee = $find->first();

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
                        'token_login' => $employee->remember_token,
                        'user' => (object)array(
                            'username' => $employee->username,
                            'nis' => $employee->nis,
                        ),
                        'role' => $employeeGroup,
                        'module' => $module
                    );

                    $request->session()->put($session);

                    return $next($request);
                }

                return redirect(route('auth.login',array('redirect'=>rawurlencode(url()->current()))));
            }

            return redirect(route('auth.login',array('redirect'=>rawurlencode(url()->current()))));
        }

        return $next($request);
    }

}
