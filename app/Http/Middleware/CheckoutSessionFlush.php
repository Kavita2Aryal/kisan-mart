<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;

class CheckoutSessionFlush
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
        // if (Session::has('direct-checkout')) {
        //     Session::forget('direct-checkout');
        // }
        if(Auth::check() && Auth::user()->hasVerifiedEmail()){
            if (Session::has(Auth::user()->uuid))
            {
                Session::forget(Auth::user()->uuid);
            }
        }
        return $next($request);
    }
}
