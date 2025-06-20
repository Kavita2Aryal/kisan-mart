<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Ecommerce\Customer;
use App\Models\Ecommerce\CustomerBillingDetail;
use App\Models\Ecommerce\CustomerShippingDetail;
use App\Models\Ecommerce\ProductReview;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Services\Ecommerce\CustomerService;
use App\Services\Ecommerce\OrderService;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use OpenGraph;
use Response;
use SEOMeta;
use Twitter;
use Validator;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('ecommerce.customer.dashboard');
    }

    public function address()
    {
        $billing_address        = CustomerBillingDetail::where('customer_id', Auth::user()->id)->where('is_active', 10)->first();
        $shipping_address       = CustomerShippingDetail::where('customer_id', Auth::user()->id)->where('is_active', 10)->first();
        return view('ecommerce.customer.address', compact('billing_address', 'shipping_address'));
    }

    public function index()
    {
        return view('ecommerce.customer.index');
    }

    public function profile_edit()
    {
        return view('ecommerce.profile.edit');
    }

    public function profile_update(Request $request)
    {
        if (CustomerService::_profile_update($request)) {
            return redirect()->route('profile')->with('success-notify', 'Your profile has been updated.');
        }
        return redirect()->back()->withInput()->with('error-notify', 'Sorry, could not update your profile at this time. Please try again later.');
    }

    public function getProduct(Request $request)
    {
        if ($request->ajax()  && isset($request->id) && isset($request->diamond)) {
            $data = OrderDetail::where('order_id', '=', $request->id)
                ->where('product_id', '=', $request->product)->with('order')->with('product')->with('images')->first();
            return Response::json(['status' => 'success', 'data' => $data], 200);
        }
        return Response::json(['status' => 'failed'], 400);
    }

    public function order_history(Request $request)
    {
        $data = Order::where('customer_id', Auth::user()->id)->orderBy('created_at', 'DESC');
        $data = $data->paginate(10);
        $html = view('includes.paginate', compact('data'));
        $order_status = get_list_group('order-status');
        return view('ecommerce.customer.history', compact('data', 'html', 'order_status'));
    }

    public function getOrderDetail(Request $request, $uuid)
    {
        $result = OrderService::_get_order_detail($uuid);
        
        if ($result) {
            $order = $result['order'];
            $status = $result['status'];
            return view('ecommerce.order-tracking.show', compact('order', 'status'));
        }
        return redirect()->back()->withInput()->with('error-notify', 'Sorry, could not find your order.');
    }   

    public function policy_agreed(Request $request)
    {
        if(!$request->ajax()){ abort(404); }
        if(CustomerService::_policy_agreed()){
            return Response::json(['status' => 'success'], 200);
        }
        return Response::json(['status' => 'failed'], 400);
    }
}
