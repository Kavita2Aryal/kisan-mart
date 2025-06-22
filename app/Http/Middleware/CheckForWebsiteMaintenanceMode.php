<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\General\Setting;

class CheckForWebsiteMaintenanceMode
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
        if ($mode = get_setting('maintenance-mode')) {
            if ($mode == 'ON') {
                return redirect()->route('maintenance');
            }
        }
        return $next($request);
    }
}
