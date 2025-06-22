<?php

namespace App\Http\Middleware\Custom;

use Closure;

class CheckLockScreen
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
        if (session()->get('lockscreen-status') == 'YES') {
            return redirect()->route('lockscreen.locked');
        }
        return $next($request);
    }
}
