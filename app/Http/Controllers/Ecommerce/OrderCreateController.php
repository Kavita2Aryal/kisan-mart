<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Area;
use App\Models\Ecommerce\City;
use App\Models\Ecommerce\Country;
use App\Models\Ecommerce\Order\OrderProductSelected;
use App\Models\Ecommerce\Region;
use App\Services\Ecommerce\BrandService;
use App\Services\Ecommerce\CategoryService;
use App\Services\Ecommerce\Order\OrderCreateService;
use App\Services\Ecommerce\Order\OrderService;
use Illuminate\Http\Request;
use Session;
use Auth;

class OrderCreateController extends Controller
{
    public function create(Request $request)
    {
        if(isset($request->products) && $request->products != null)
        {
            OrderCreateService::_update_selected_items($request->products);
            $products = OrderCreateService::_get();
            $data = OrderCreateService::_calculate_total($products);
            $order_status = get_list_group('order-status');
            $payment_type = get_list_group('payment_type');
            $countries = Country::where('is_active', 10)->get();
            $regions = Region::where('is_active', 10)->get()->map->_format();
            $cities  = City::where('is_active', 10)->get()->map->_format();
            $areas = Area::where('is_active', 10)->get()->map->_format();
            return view('modules.ecommerce.order.new.create', 
                        compact(
                            'products', 
                            'data', 
                            'order_status',
                            'payment_type',
                            'countries',
                            'regions',
                            'cities',
                            'areas'
                        ));
        }
        return back()->with('warning', 'Please select the product.');
    }

    public function store(Request $request)
    {
        if($status = OrderCreateService::_storing($request)){
            $route = 'order.'.$status;
            return redirect()->route($route);
        }
        return back()->with('warning', 'Couldnot Create Order at the moment. Please try again later');
    }

    public function selectItems(Request $request)
    {
        $data = [];
        $categories = CategoryService::_get();
        $brands = BrandService::_get();
        $data = OrderCreateService::_get();
        return view('modules.ecommerce.order.new.select-items', compact('data', 'categories', 'brands'));
    }

    public function saveSelectedItems(Request $request)
    {
        if (!$request->has('products')) {
            return back()->with('warning', 'Please add some products before submiting.');
        }

        OrderCreateService::_save_selected_items($request->products);
        return back()->with('success', 'Products has been added.');
    }

    public function removeSelectedItems(Request $request)
    {
        if ($request->has('products')) {
            OrderCreateService::_remove_selected_items($request->products);
        }
        return response()->json(['status' => true], 200);
    }

    public function updateSelectedItems(Request $request)
    {
        dd($request->all());
        if($request == null) {
            return response()->json(['status' => false], 200);
        }
        $response = OrderCreateService::_x_update_selected_items($request);
        return response()->json(['status' => $response], 200);
    }
}
