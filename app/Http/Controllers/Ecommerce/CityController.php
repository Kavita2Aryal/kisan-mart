<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\CityRequest;
use App\Services\Ecommerce\CityService;
use App\Services\Ecommerce\RegionService;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = CityService::_paging($request);
        return view('modules.ecommerce.city.index', compact('cities'));
    }

    public function create()
    {
        $regions = RegionService::_get();
        return view('modules.ecommerce.city.create', compact('regions'));
    }

    public function store(CityRequest $request)
    {
        if (CityService::_storing($request)) {
            return redirect()->route('city.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create city at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $city = CityService::_find($uuid);
        $regions = RegionService::_get();
        return view('modules.ecommerce.city.edit', compact('city', 'regions'));
    }

    public function update(CityRequest $request, $uuid)
    {
        if (CityService::_updating($request, $uuid)) { 
            return redirect()->route('city.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update city at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = CityService::_change_status($uuid);
        return response()->json($response, 200);
    }
}