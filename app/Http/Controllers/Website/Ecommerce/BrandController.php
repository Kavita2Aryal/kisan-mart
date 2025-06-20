<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Services\Ecommerce\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = BrandService::_get();
        return view('ecommerce.brand.index', compact('brands'));
    }
}