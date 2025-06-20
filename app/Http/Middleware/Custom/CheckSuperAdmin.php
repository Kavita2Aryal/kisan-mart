<?php

namespace App\Http\Middleware\Custom;

use Closure;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role->is_super != 10) {
            return abort(404);
        }
        return $next($request);
    }
}
