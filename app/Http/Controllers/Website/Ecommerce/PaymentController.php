<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Ecommerce\CheckoutService;
use App\Services\Ecommerce\CheckoutStatusService;
use App\Services\Ecommerce\PaymentEsewaService;
use App\Services\Ecommerce\PaymentFonepayService;
use App\Services\Ecommerce\PaymentHblService;
use Carbon\Carbon;
use DB;
use Response;
use Session;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('id') && $request->has('id') != '') {
            $params = decrypt($request->get('id'));
            $params = explode("___", $params);

            if (count($params) == 2) {
                $uuid = $params[0];
                $check_timestamp   = strtotime('+60 minutes', $params[1]);
                $current_timestamp = time();
                if ($check_timestamp >= $current_timestamp) {
                    if (Session::has($uuid)) {
                        $data = Session::get($uuid);
                        $payment_options = get_list_group('payment_type');
                        $payment_options_check = get_list_group('payment_type_check');
                        $payment_options_status = explode(',', get_setting('payment-options'));
                        $config_payment_options = config('app.addons_config.payment_options');
                        return view('ecommerce.payment.index', compact('data', 'payment_options', 'payment_options_check', 'payment_options_status', 'config_payment_options', 'uuid'));
                    }
                }
            }
        }
        abort(404);
    }

    public function fonepay_verify(Request $request)
	{
		try 
        {
	    	$validator = Validator::make($request->all(), [
	            'PRN' => 'required',
	            'BID' => 'required',
	            'UID' => 'required',
	        ]);

	        if ($validator->fails()) { 
				$url = get_payment_url();
                return redirect($url)->with('error-notify', 'Unauthorised Request / Payment has been cancelled.');
	        }

	        $result = PaymentFonepayService::_check($request->all());
            if($result['status'])
            {
                return redirect($result['url']);
            }else{
                return redirect($result['url'])->with('error-notify', 'Something Went Wrong. Please try again later!');
            } 
	    } 
        catch (Exception $e) 
        {
            $url = get_payment_url();
            return redirect($url)->with('error-notify', 'Something Went Wrong. Please try again later!');
        }
	}

    public function esewa_success(Request $request)
    {
        try 
        {
	    	$validator = Validator::make($request->all(), [
	            'oid' => 'required',
	            'amt' => 'required',
	            'refId' => 'required',
	        ]);

	        if ($validator->fails()) { 
				$url = get_payment_url();
                return redirect($url)->with('error-notify', 'Unauthorised Request / Payment has been cancelled.');
	        }
            $result = PaymentEsewaService::_check($request);
            if($result['status'])
            {
                return redirect($result['url']);
            }else{
                return redirect($result['url'])->with('error-notify', 'Something Went Wrong. Please try again later!');
            }   

	    } 
        catch (Exception $e) 
        {
            $url = get_payment_url();
            return redirect($url)->with('error-notify', 'Something Went Wrong. Please try again later!');
        }
    }

    public function esewa_failed(Request $request)
    {
        $url = get_payment_url();
        return redirect($url)->with('error-notify', 'Payment Failed');
    }

    public function hbl_backend(Request $request)
    { 
	    PaymentHblService::_check_backend($request->all());
    }

    public function hbl_frontend(Request $request)
    {   
        try 
        {
	    	$validator = Validator::make($request->all(), [
	            'Amount'        => 'required',
	            'respCode'      => 'required',
	            'fraudCode'     => 'required',
	            'approvalCode'  => 'required',
	            'Eci'           => 'required',
	            'Status'        => 'required',
	            'userDefined1'  => 'required',
	            'userDefined2'  => 'required',
	            'userDefined4'  => 'required'
	        ]);

	        if ($validator->fails()) { 
				return Response::json(['status' => 'failed', 'msg' => 'unauthorised request / payment has been cancelled by client.' ]); 
	        }

	        $result = PaymentHblService::_check($request->all());
            if ($result['status'] == 200) { 
                return Response::json(['status' => 'success', 'msg' => $result['order']]);
            }
            else {
                return Response::json(['status' => 'failed', 'msg' => $result['msg']]);
            }
	    } 
        catch (Exception $e) 
        {
            return Response::json(['status' => 'failed', 'msg' => 'Something went Wrong, Try Again' ]); 
        }
    }
}
