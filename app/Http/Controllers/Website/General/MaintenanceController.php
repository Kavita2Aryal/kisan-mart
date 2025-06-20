<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;

class MaintenanceController extends Controller
{
    public function show()
    {
        if (get_setting('maintenance-mode') == 'ON') {
            return view('cms.maintenance');
        }
        return redirect()->route('home');
    }
}
