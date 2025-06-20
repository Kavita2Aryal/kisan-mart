<?php

namespace App\Http\Middleware\Custom;

use Closure;

class AddPage
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
        if (config('app.config.cms_page_add') != 'YES') {
            return abort(404);
        }
        return $next($request);
    }
}
