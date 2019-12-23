<?php
namespace App\Http\Middleware;

use Closure;

class Guest
{
    public function handle($request, Closure $next)
    {

        /*
         * if has session logged_in
         */
        if ($request->session()->has('logged_in') && $request->session()->has('token_login'))
        {
            return redirect('/');
        }

        return $next($request);
    }
}
