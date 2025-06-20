<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\BrandRequest;
use App\Services\Ecommerce\BrandService;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $url = get_setting('website-domain');
        $brands = BrandService::_paging($request);
        return view('modules.ecommerce.brand.index', compact('brands', 'url'));
    }

    public function create()
    {
        $url = get_setting('website-domain');
        return view('modules.ecommerce.brand.create', compact('url'));
    }

    public function store(BrandRequest $request)
    {
        if (BrandService::_storing($request)) {
            return redirect()->route('brand.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create brand at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $brand = BrandService::_find($uuid);
        $url = get_setting('website-domain');
        return view('modules.ecommerce.brand.edit', compact('brand', 'url'));
    }

    public function update(BrandRequest $request, $uuid)
    {
        if (BrandService::_updating($request, $uuid)) {
            return redirect()->route('brand.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update brand at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = BrandService::_change_status($uuid);
        return response()->json($response, 200);
    }
}
