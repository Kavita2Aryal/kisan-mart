<?php

namespace App\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Delivery\DeliveryArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use DB;
use Session;
use Response;

use App\Services\Ecommerce\CheckoutService;
use App\Helpers\Support;
use App\Http\Requests\CheckoutRequest;
use App\Models\Ecommerce\Area;
use App\Models\Ecommerce\City;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Product\ProductVariant;
use App\Models\Ecommerce\Region;
use App\Services\Ecommerce\CheckoutStatusService;
use App\Services\Ecommerce\PaymentService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $_auth = new Support();
        $details                = CheckoutService::get_shipping_details();
        $shipping_options       = $details['shipping_options'];
        $billing_options        = $details['billing_options'];
        $defaultShippingData    = $details['defaultShippingData'];
        $defaultBillingData     = $details['defaultBillingData'];
        $countries              = $details['countries'];
        $regions                = $details['regions'];
        $cities                 = $details['cities'];
        $areas                  = $details['areas'];

        $checkout   = CheckoutService::get_subtotal();
        $vat        = $checkout['vat'];
        $subtotal   = $checkout['subtotal'];
        $carts      = $checkout['carts'];
        $sum        = $checkout['sum'];
        $has_gift_voucher        = $checkout['has_gift_voucher'];
        $has_product        = $checkout['has_product'];
        $gift_voucher_options = get_list_group('gift-voucher-option');
        $checkout_status = CheckoutStatusService::_save($_auth->_customer, $carts, 'cart');
        if (count($carts) > 0) {
            return view('ecommerce.checkout.index', compact('vat', 'subtotal', 'has_gift_voucher', 'has_product', 'defaultShippingData', 'defaultBillingData', 'countries', 'regions', 'cities', 'areas', 'carts', 'shipping_options', 'billing_options', '_auth', 'sum', 'gift_voucher_options'));
        } else {
            return redirect()->back()->with('error', 'Sorry! You cart is Empty.');
        }
    }

    public function prepareQuick(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'qty'     => 'required|integer|gt:0',
                'product' => 'sometimes|uuid|exists:products,uuid',
                'sku'     => 'sometimes|exists:product_variants,sku',
                'gift_voucher'  => 'sometimes|uuid|exists:gift_vouchers,uuid',
            ]);
            if (!$validator->fails()) {
                if (Session::has('direct-checkout')) {
                    Session::forget('direct-checkout');
                }

                $sessionData = $request->has('product') ?
                    [
                        'product_uuid'  => $request->product,
                        'qty'           => $request->qty,
                        'product_sku'   => $request->sku
                    ] :
                    [
                        'gift_voucher_uuid'     => $request->gift_voucher,
                        'price'                 => $request->price,
                        'qty'                   => $request->qty,
                    ];
                Session::put('direct-checkout', $sessionData);
                return Response::json(['status' => true]);
            }
            return Response::json(['status' => false]);
        }
        abort(403);
    }

    public function quick()
    {
        if (Session::has('direct-checkout')) {
            $_auth = new Support();

            $details                = CheckoutService::get_shipping_details();
            $shipping_options       = $details['shipping_options'];
            $billing_options        = $details['billing_options'];
            $defaultShippingData    = $details['defaultShippingData'];
            $defaultBillingData     = $details['defaultBillingData'];
            $countries              = $details['countries'];
            $regions                = $details['regions'];
            $cities                 = $details['cities'];
            $areas                  = $details['areas'];

            $checkout   = CheckoutService::get_session_subtotal();
            $vat        = $checkout['vat'];
            $subtotal   = $checkout['subtotal'];
            $data       = $checkout['data'];
            $sum        = $checkout['sum'];

            $selling_price   = isset($checkout['selling_price']) ? $checkout['selling_price'] : null;
            $product    = isset($checkout['product']) ? $checkout['product'] : null;
            $variant    = isset($checkout['variant']) ? $checkout['variant'] : null;
            $pricing    = isset($checkout['pricing']) ? $checkout['pricing'] : null;
            $price   = isset($checkout['price']) ? $checkout['price'] : null;
            $gift_voucher    = isset($checkout['gift_voucher']) ? $checkout['gift_voucher'] : null;
            $has_gift_voucher = isset($checkout['gift_voucher']) ? true : false;
            $has_product = isset($checkout['product']) ? true : false;

            $checkout_status = CheckoutStatusService::_save($_auth->_customer, $data, 'direct');
            $gift_voucher_options = get_list_group('gift-voucher-option');

            return view('ecommerce.checkout.index', compact('vat', 'selling_price', 'subtotal', 'has_gift_voucher', 'has_product', 'defaultShippingData', 'defaultBillingData', 'countries', 'regions', 'cities', 'areas', 'product', 'variant', 'pricing', 'data', 'shipping_options', 'billing_options', '_auth', 'sum', 'price', 'gift_voucher', 'gift_voucher_options'));
        }
        return redirect()->back()->with('error', 'Sorry! Something went wrong.');
    }

    public function submit(Request $request)
    {
        try {
            if ($request->has('payment_option') && $request->payment_option != '') {
                $payment_option = $request->payment_option;
                $result = CheckoutService::create_order_generate_url($request->uuid, $payment_option);
                if($payment_option != ''){
                    if ($result['order_code'] != null) {
                        $order = Order::where(['order_code' => $result['order_code']])->first();

                        if($order) {
                            if($payment_option == 'esewa')
                            {
                                $esewa = config('app.addons_config.payment_options.esewa');
                                return view('ecommerce.payment.esewa', compact('esewa', 'order'));
                            }
                            if($payment_option == 'fonepay')
                            {
                                $fonepay = config('app.addons_config.payment_options.fonepay');
                                return view('ecommerce.payment.fonepay', compact('fonepay', 'order'));
                            }
                        }
                    }
                }
                return redirect($result['url']);
            }
            return back()->with('error-notify', 'Something Went Wrong. Please Try Again.');
        } catch (Exception $e) {
            return redirect()->back()->with('error-notify', 'Something Went Wrong. Please Try Again.');
        }
    }

    public function proceedToPayment(Request $request)
    {
        try {
            if ($request != null) {
                $url = CheckoutService::_proceed_to_payment($request);
                return redirect($url);
            }
            return back()->with('error-notify', 'Something Went Wrong. Please Try Again.');
        } catch (Exception $e) {
            return redirect()->back()->with(['status' => 'failed', 'msg' => 'Something went Wrong, Try Again']);
        }
    }

    public function getDeliveryCharge($area_id ,$day,$sub_total)
    {
        $deliveryCharge = DeliveryArea::where(['area_id'=>$area_id,'day'=>$day])->first();
        $deliveryChargeOfArea = Area::find($area_id)->delivery_charge;

        if ($deliveryCharge){

            if ($sub_total > $deliveryCharge->delivery->minimum_order_amount)
            {
                if ($deliveryCharge){
                    if ($deliveryCharge->delivery->delivery_type == 1)   //free delivery
                    {
                        return Response::json([
                            'status' => true,
                            'discount_value' => 0,
                            'message' => "FREE DELIVERY"

                        ]);
                    }
                    else{

                        if ($deliveryCharge->delivery->discount_type ==1){

                            return Response::json([
                                'status' => true,
                                'discount_value' => $deliveryCharge->delivery->discount_value,
                                'discount_type'=>'fixed',
                                'area_delivery_charge' => $deliveryChargeOfArea,
                                'discount'=> $deliveryCharge->delivery->discount_value,

                            ]);
                        }else{

                            return Response::json([
                                'status' => true,
                                'discount_value' => ($deliveryCharge->delivery->discount_value/100)* $deliveryChargeOfArea,
                                'discount_type'=>'percentage',
                                'area_delivery_charge' => $deliveryChargeOfArea,
                                'discount'=> $deliveryCharge->delivery->discount_value,

                            ]);

                        }

                    }
                }

                return Response::json(['status' => false]);

            }
        }



        return Response::json(['status' => false]);
    }

    public function status(Request $request)
    {
        if ($request->has('id') && $request->has('id') != '') {
            $data = CheckoutService::_get_status($request);
            if($data['result'])
            {
                $order = $data['order'];
                $status = $data['status'];
                return view('ecommerce.checkout.order-detail', compact('order', 'status'));
            }
        }
        abort(404);
    }

    public function getRegion(Request $request)
    {
        return Region::where('country_id', $request->country_id)->where('is_active', 10)->select('id', 'name')->get();
    }

    public function getCity(Request $request)
    {
        return City::where('region_id', $request->region_id)->where('is_active', 10)->select('id', 'name')->get();
    }

    public function getArea(Request $request)
    {
        return Area::where('city_id', $request->city_id)->where('is_active', 10)->get();
    }
}
