<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ecommerce\Customer;
use Validator;
use Auth;
use Response;

use App\Models\Ecommerce\Country;
use App\Models\Ecommerce\Region;
use App\Models\Ecommerce\City;
use App\Models\Ecommerce\Area;
use App\Models\Ecommerce\CustomerShippingDetail;
use App\Services\Ecommerce\CustomerShippingDetailService;

class CustomerShippingDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data       = CustomerShippingDetail::with('getCountry', 'getRegion', 'getCity', 'getArea')->where('customer_id', Auth::user()->id)->where('is_active', 10)->first();

        $countries  = Country::orderBy('name', 'ASC')->get();
        $regions    = Region::where('is_active', 10)->get()->map->_format();
        $cities     = City::where('is_active', 10)->get()->map->_format();
        $areas      = Area::where('is_active', 10)->get()->map->_format();

        return view('ecommerce.customer.shipping', compact('data', 'countries', 'regions', 'cities', 'areas'));
    }

    public function save(Request $request)
    {
        if (CustomerShippingDetailService::_save($request)) {
            return redirect()->route('address')->with('success-notify', 'The shipping detail has been saved.');
        }
        return redirect()->back()->withInput()->with('error-notify', 'Sorry, could not update the shipping detail at this time. Please try again later.');
    }

    public function get(Request $request)
    {
        if ($request->ajax()  && isset($request->id) && isset($request->id)) {
            $data = CustomerShippingDetail::where('id', $request->id)->first();
            return Response::json(['status' => 'success', 'data' => $data], 200);
        }
        return Response::json(['status' => 'failed'], 400);
    }

    public function getShippingEdit($id)
    {
        $data       = CustomerShippingDetail::where('id', $id)->first();
        return view('ecommerce.customer.shipping-edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'             => 'required',
            'address_line_1'        => 'required',
            'country'            => 'required',
            'region'            => 'required',
            'city'              => 'required',
            'area'              => 'required'

        ]);
        if (!$validator->fails()) {
            if (CustomerShippingDetailService::_update($request)) {
                return redirect()->route('shipping.index')->with('success', 'The shipping detail has been updated.');
            }
            return redirect()->back()->withInput()->with('error', 'Sorry, could not update the shipping detail at this time. Please try again later.');
        }
        return redirect()->back()->withInput()->withErrors($validator);
    }

    public function remove($id)
    {
        if (CustomerShippingDetailService::_remove($id)) {
            return redirect()->back()->with('success', 'The Customers shipping detail has been removed.');
        }
        return redirect()->back()->with('error', 'Sorry, could not remove the customers shipping detail at this time. Please try again later.');
    }

    public function viewAllShipping()
    {
        $shipping_address        = CustomerShippingDetail::where('customer_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get()->map->format();
        return view('ecommerce.shipping.view-all', compact('shipping_address'));
    }
}
