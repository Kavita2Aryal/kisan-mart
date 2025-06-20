<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Helpers\Support;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Order\Order;
use App\Services\Ecommerce\OrderTrackingService;
use App\Services\General\Export;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('ecommerce.order-tracking.index');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_code' => 'required',
            'email'      => 'required|email|exists:customers,email'
        ]);


        if (!$validator->fails()) {
            $data = OrderTrackingService::_get_order($request);
            if ($data['status']) {
                return redirect($data['url']);
            } else {
                return redirect()->back()->withInput($request->only('email', 'order_code'))->withErrors([
                    'order_code' => 'This order code is not associated with your email address.',
                ]);
            }
        }
        return redirect()->back()->withInput()->withErrors($validator);
    }

    public function check(Request $request)
    {
        if ($request->has('id') && $request->has('id') != '') {
            $data = OrderTrackingService::_check($request);
            if ($data['result']) {
                $order = $data['order'];
                $status = $data['status'];
                return view('ecommerce.order-tracking.show', compact('order', 'status'));
            }
        }
        abort(404);
    }
    
    public function export_pdf($uuid)
    {
        $order = OrderTrackingService::_get_details($uuid);
        if($order){
            return Export::pdf($order, $order->order_code.'-order-details', 'order-detail');
        }else{
            abort(404);
        }
    }
}
