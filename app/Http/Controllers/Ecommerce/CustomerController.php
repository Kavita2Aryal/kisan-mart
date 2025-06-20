<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\CustomerStore;
use App\Http\Requests\Ecommerce\CustomerUpdate;
use App\Models\Ecommerce\Customer;
use App\Services\Ecommerce\CustomerService;
use App\Services\General\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = CustomerService::_paging($request);
        return view('modules.ecommerce.customer.index', compact('customers'));
    }
    public function create()
    {
        return view('modules.ecommerce.customer.create');
    }

    public function store(CustomerStore $request)
    {
        if (CustomerService::_storing($request)) {
            return redirect()->route('customer.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create customer at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $customer = CustomerService::_find($uuid);
        return view('modules.ecommerce.customer.edit', compact('customer'));
    }

    public function update(CustomerUpdate $request, $uuid)
    {
        if (CustomerService::_updating($request, $uuid)) {
            return redirect()->route('customer.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update customer at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = CustomerService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function order($uuid)
    {
        $customer = CustomerService::_find($uuid);
        $orders = CustomerService::_order_history($customer->id);
        return view('modules.ecommerce.customer.order-history', compact('customer', 'orders'));
    }

    public function order_detail(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->code) && $request->code != null) {
                $data = CustomerService::_order_detail($request->code);
                $order                      = $data['order'];
                $product_details            = $data['product_details'];
                $order_billing_address      = $data['order_billing_address'];
                $order_shipping_address     = $data['order_shipping_address'];
                $order_status_lists         = $data['order_status_lists'];
                $order_status               = get_list_group('order-status');
                $gift_voucher_options       = get_list_group('gift-voucher-option');
                $html = view('modules.ecommerce.customer.includes.order-detail', compact('order', 'product_details', 'order_billing_address', 'order_shipping_address', 'order_status_lists', 'order_status', 'gift_voucher_options'))->render();
                return response()->json([
                    'status' => true,
                    'html' => $html
                ]);
            }

            return response()->json(['status' => false]);
        }
        abort(404);
    }

    public function export_csv()
    {
        $data = CustomerService::_get();
        $customers = CustomerService::_format_for_csv($data);
        return ExportService::csv($customers, 'customers');
    }

    public function search(Request $request)
    {
    	$data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = Customer::select(['id','name'])
                    ->where('is_active', 10)
            		->get();
        }
        return response()->json($data);
    }
}