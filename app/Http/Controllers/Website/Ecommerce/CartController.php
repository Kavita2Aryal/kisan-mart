<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Validator;
use App\Helpers\Support;
use App\Models\Ecommerce\Cart;
use Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $_auth = new Support();
            $carts = $_auth->cart_get();
            return view('ecommerce.cart.index', compact('carts', '_auth'));
        } else {
            return redirect()->route('login')->with('error-notify', 'You need to login to proceed');
        }
    }

    public function addup(Request $request)
    {
        if (!$request->ajax()) { abort(403); }
        if (Auth::user()) {
            $validator = Validator::make($request->all(), [
                'qty'     => 'required|integer|gt:0',
                'product' => 'sometimes|uuid|exists:products,uuid',
                'sku'     => 'sometimes|exists:product_variants,sku',
                'gift_voucher'  => 'sometimes|uuid|exists:gift_vouchers,uuid',
            ]);
            if (!$validator->fails()) {
                $_auth = new Support();
                $status = $_auth->cart_addup($request->all());
                $count = $_auth->cart_count();
                $carts = $_auth->cart_get();
                $html = view('includes.cart-flip', compact('carts'))->render();
                return Response::json(['status' => $status, 'count' => $count, 'html' => $html]);
            }
            return Response::json(['status' => false]);
        }

        $customer_login_url = route('login');
        return Response::json(['status' => false, 'auth' => false, 'customer_login_url' => $customer_login_url]);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()) { abort(403); }
        if (Auth::user()) {
            $validator = Validator::make($request->all(), [
                'qty'     => 'required|integer|gt:0',
                'product' => 'sometimes|uuid|exists:products,uuid',
                'sku'     => 'sometimes|exists:product_variants,sku',
                'gift_voucher'  => 'sometimes|uuid|exists:gift_vouchers,uuid',
            ]);
            if (!$validator->fails()) {
                $_auth = new Support();
                $_auth->cart_update($request->all());
                $count = $_auth->cart_count();
                $carts = $_auth->cart_get();
                $html = view('includes.cart-flip', compact('carts'))->render();
                return Response::json(['status' => true, 'count' => $count, 'html' => $html]);

            }
            return Response::json(['status' => false]);
        }
        $customer_login_url = route('login');
        return Response::json(['status' => false, 'auth' => false, 'customer_login_url' => $customer_login_url]);
    }

    public function remove(Request $request)
    {
        if (!$request->ajax()) { abort(403); }
        $validator = Validator::make($request->all(), [
            'uuid' => 'required|uuid|exists:carts,uuid',
        ]);
        if (!$validator->fails()) {
            $_auth = new Support();
            $_auth->cart_remove($request->all());
            $count = $_auth->cart_count();
            $carts = $_auth->cart_get();
            $html = view('includes.cart-flip', compact('carts'))->render();
            return Response::json(['status' => true, 'count' => $count, 'html' => $html]);
        }
        return Response::json(['status' => false]);
    }

    public function removeAll(Request $request)
    {
        $_auth = new Support();
        $_auth->cart_remove_all();
        $count = $_auth->cart_count();

        return Response::json(['status' => true, 'count' => $count]);
    }

}
