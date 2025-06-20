<?php

namespace App\Http\Controllers\Build;
 
use App\Http\Controllers\Controller;

use App\Services\Build\DomainFixerService;

class DomainFixerController extends Controller
{
    public function change()
    {
        $search = 'https://sutkeri.com';
        $replace = 'http://127.0.0.1:8000';

        DomainFixerService::change_for_addons($search, $replace);
        DomainFixerService::change_for_cms($search, $replace);
        DomainFixerService::change_for_general($search, $replace);
        DomainFixerService::change_for_ecommerce($search, $replace);
        cache()->flush();

        return back()
            ->with('success', 'Domain fix process complete.');
    }
}