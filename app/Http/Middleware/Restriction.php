<?php
namespace App\Http\Middleware;

use Closure;

class Restriction
{

    public function handle($request, Closure $next)
    {
        /*
         * define variable
         */
        $restriction = config('restriction.whitelist');
        $ip = $request->ip();

        /*
         * check ip user
         */
        if(!in_array($ip,$restriction))
        {

            header("HTTP/1.0 403 Internal Server Error");
            exit();
        }

        return $next($request);
    }
}
