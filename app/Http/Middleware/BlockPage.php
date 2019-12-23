<?php
namespace App\Http\Middleware;

use Closure;

class BlockPage
{
    public function handle($request, Closure $next,$module,$role = 'read')
    {

        if (!mod_access($module,$role))
        {
            return abort(403, 'You don\'t have permission to access this page.');
        }

        return $next($request);
    }
}
