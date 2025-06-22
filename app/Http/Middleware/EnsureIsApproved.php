<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Redirect;

class EnsureIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user() ||
            ! $request->user()->account_verified == 10) {
            return $request->expectsJson()
                    ? abort(403, 'Your account has not been approved yet.')
                    : Redirect::route('verification.approved');
        }

        return $next($request);
    }
}
