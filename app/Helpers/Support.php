<?php

namespace App\Helpers;

use App\Models\Area;
use Illuminate\Support\Str;
use Auth;
use DB;
use Session;
use App\Models\Ecommerce\Cart;
use App\Models\Ecommerce\City;
use App\Models\Ecommerce\Wishlist;
use App\Models\Ecommerce\CustomerBillingDetail;
use App\Models\Ecommerce\CustomerShippingDetail;
use App\Models\Ecommerce\Region;

class Support
{
    public $_customer;
    public function __construct()
    {
        $this->_customer = null;

        $auth = Auth::guard('web');

        if ($auth->check() && $auth->user()->hasVerifiedEmail()) {
            $this->_customer = $auth->user();
        }
    }

    public function _policy_agreed()
    {
        $this->_customer->update([
            'has_agreed' => 10,
            'agreed_on' => Carbon::now()
        ]);
    }
    
    public function wishlist_get()
    {
        $wishlists = Wishlist::where('customer_id', $this->_customer->id)->orderBy('created_at', 'DESC')->get()->keyBy('id')->map->_formating();
        Session::has('wishlist_products') ? Session::forget('wishlist_products') : Session::put('wishlist_products', $wishlists);
        return $wishlists;
    }

    public function cart_get()
    {
        $carts = Cart::where('customer_id', $this->_customer->id)->orderBy('created_at', 'DESC')->get()->keyBy('id')->map->_formating();
        Session::has('cart_products') ? Session::forget('cart_products') : Session::put('cart_products', $carts);
        return $carts;
    }

    public function promo_cart_get($promoProducts, $type)
    {
        if ($type == 'include') {
            return Cart::where('customer_id', $this->_customer->id)->whereIN('product_uuid', $promoProducts)->get()->keyBy('product_sku')->map->_formating()->toArray();
        } else {
            return Cart::where('customer_id', $this->_customer->id)->whereNotIn('product_uuid', $promoProducts)->get()->keyBy('product_sku')->map->_formating()->toArray();
        }
    }

    public function wishlist_count()
    {
        return DB::table('wishlists')->where('customer_id', $this->_customer->id)->count('customer_id');
    }

    public function cart_count()
    {
        return DB::table('carts')->where('customer_id', $this->_customer->id)->count('customer_id');
    }

    public function cart_addup($data)
    {
        $req_data = isset($data['gift_voucher']) ? ['customer_id' => $this->_customer->id, 'gift_voucher_uuid' => $data['gift_voucher']] : ['customer_id' => $this->_customer->id, 'product_uuid' => $data['product'], 'product_sku' => $data['sku']];

        $cart = Cart::firstOrCreate($req_data, ['qty' => $data['qty'], 'uuid' => Str::uuid()->toString()]); 
        if (!$cart->wasRecentlyCreated) {
            $cart_cnt = $cart->qty + $data['qty'];

            if ($cart_cnt > 20) {
                $cart->qty = 20;
                $cart->update();
                $msg = 'max';
            } else {
                $cart->qty += $data['qty'];
                $cart->update();
                $msg = 'updated';
            }
        } else {
            $msg = 'created';
        }
        self::cart_get();
        return $msg;
    }

    public function cart_update($data)
    {
        $cart = isset($data['gift_voucher']) ? ['customer_id' => $this->_customer->id, 'gift_voucher_uuid' => $data['gift_voucher']] : ['customer_id' => $this->_customer->id, 'product_uuid' => $data['product'], 'product_sku' => $data['sku']];

        Cart::updateOrCreate($cart, ['qty' => $data['qty']]);
    }

    public function wishlist_addup($data)
    {
        $req_data = isset($data['gift_voucher']) ? ['customer_id' => $this->_customer->id, 'gift_voucher_uuid' => $data['gift_voucher']] : ['customer_id' => $this->_customer->id, 'product_uuid' => $data['product']];
        return Wishlist::firstOrCreate($req_data, ['uuid' => Str::uuid()->toString()]);
    }

    public function wishlist_remove($data)
    {
        return Wishlist::where(['customer_id' => $this->_customer->id, 'uuid' => $data['uuid']])->delete();
    }

    public function cart_remove($data)
    {
        return Cart::where(['customer_id' => $this->_customer->id, 'uuid' => $data['uuid']])->delete();
    }

    public function cart_removes($product_uuids, $gift_voucher_uuids)
    {
        if (count($product_uuids) > 0) {
            foreach ($product_uuids as $d) {
                Cart::where('customer_id', $this->_customer->id)->where(['product_uuid' => $d['uuid'], 'product_sku' => $d['sku']])->delete();
            }
        }
        if (count($gift_voucher_uuids) > 0) {
            foreach ($gift_voucher_uuids as $d) {
                Cart::where('customer_id', $this->_customer->id)->where(['gift_voucher_uuid' => $d['uuid']])->delete();
            }
        }
    }

    public function cart_remove_all()
    {
        Cart::where(['customer_id' => $this->_customer->id])->delete();
    }

    public function billing_address_create($data)
    {
        CustomerBillingDetail::create($data);
    }

    public function shipping_address_create($data)
    {
        CustomerShippingDetail::create($data);
    }
}
