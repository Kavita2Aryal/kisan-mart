<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\RegionRequest;
use App\Services\Ecommerce\RegionService;
use App\Services\Ecommerce\CountryService;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $regions = RegionService::_paging($request);
        return view('modules.ecommerce.region.index', compact('regions'));
    }

    public function create()
    {
        $countries = CountryService::_get();
        return view('modules.ecommerce.region.create', compact('countries'));
    }

    public function store(RegionRequest $request)
    {
        if (RegionService::_storing($request)) {
            return redirect()->route('region.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create region at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $region = RegionService::_find($uuid); 
        $countries = CountryService::_get();
        return view('modules.ecommerce.region.edit', compact('region', 'countries'));
    }

    public function update(RegionRequest $request, $uuid)
    {
        if (RegionService::_updating($request, $uuid)) {
            return redirect()->route('region.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update region at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = RegionService::_change_status($uuid);
        return response()->json($response, 200);
    }
}