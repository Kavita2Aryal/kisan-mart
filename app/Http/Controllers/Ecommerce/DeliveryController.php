<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Area;
use App\Services\Ecommerce\DeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function index(Request  $request)
    {
        $deliveries = DeliveryService::_paging($request);
        return view('modules.ecommerce.delivery.index',compact('deliveries'));
    }


    public function create()
    {
        $areas = Area::all();
        $discount_types = get_list_group('discount-type');
        return view('modules.ecommerce.delivery.create',compact('areas','discount_types'));
    }


    public function store(Request $request)
    {
        if (DeliveryService::_storing($request)) {
            return redirect()->route('delivery.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create delivery at this time. Please try again later.');
    }


    public function edit($uuid)
    {
        $delivery = DeliveryService::_find($uuid);
        $areas = Area::all();
        $discount_types = ['1'=>'Amount','2'=>'Percentage'];
        return view('modules.ecommerce.delivery.edit', compact('delivery','areas','discount_types'));
    }

    public function update(Request $request, $uuid)
    {
        if (DeliveryService::_updating($request, $uuid)) {
            return redirect()->route('delivery.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update delivery at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = DeliveryService::_change_status($uuid);
        return response()->json($response, 200);
    }
}
