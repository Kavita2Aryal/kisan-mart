<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\AreaRequest;
use App\Services\Ecommerce\AreaService;
use App\Services\Ecommerce\CityService;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = AreaService::_paging($request);
        return view('modules.ecommerce.area.index', compact('areas'));
    }

    public function create()
    {
        $cities = CityService::_get();
        return view('modules.ecommerce.area.create', compact('cities'));
    }

    public function store(AreaRequest $request)
    {
        if (AreaService::_storing($request)) {
            return redirect()->route('area.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create area at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $area = AreaService::_find($uuid);
        $cities = CityService::_get();
        return view('modules.ecommerce.area.edit', compact('area', 'cities'));
    }

    public function update(AreaRequest $request, $uuid)
    {
        if (AreaService::_updating($request, $uuid)) {
            return redirect()->route('area.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update area at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = AreaService::_change_status($uuid);
        return response()->json($response, 200);
    }
}