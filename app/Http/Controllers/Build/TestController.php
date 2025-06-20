<?php

namespace App\Http\Controllers\Build;
 
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        return view('modules.build.test.index',);
    }
}