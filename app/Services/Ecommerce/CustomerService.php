<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Customer;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\Order\OrderStatus;
use App\Models\Ecommerce\OrderBillingAddress;
use App\Models\Ecommerce\OrderShippingAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerService
{
    public static function _get()
    {
        return Customer::orderBy('name', 'ASC')->get();
    }

    public static function _find($uuid)
    {
        return Customer::where('uuid', $uuid)->first();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Customer::with('orders')->orderBy('name', 'ASC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new Customer();
        $model->name = $req->name;
        $model->email = $req->email;
        $model->phone = $req->phone;
        $model->password = ($req->filled('password')) ? Hash::make($req->password): null;
        $model->email_verified_at = ($req->filled('email')) ? Carbon::now() : null;
        $model->encrypt = Str::random(64) . '-' . time();
        $model->has_agreed = 10;
        $model->agreed_on = Carbon::now();
        $model->is_active = 10;
        $model->is_social_only = 0;
        
        return $model->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->name = $req->name;
        $model->email = $req->email;
        $model->phone = $req->phone;
        if ($req->filled('password')) {
            $model->password = Hash::make($req->password);
        }

        return $model->update() ? true : false;
    }

    public static function _order_history($customer_id)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);
        $data = Order::with('exchangeRate.currency')->where('customer_id', $customer_id)->orderBy('orders.created_at', 'DESC');
        if ($search) { 
            $data->orWhere('order_code', 'LIKE', '%'.$search.'%');
            
        }
        return $data->paginate($per_page);
    }

    public static function _order_detail($code)
    {
        $order                   = Order::with('customer')->where(['order_code' => $code])->first();
        $product_details  = OrderDetail::with(['product', 'variation'])->where('order_id', $order->id)->whereNotNull('product_id')->get();
        $order_billing_address   = OrderBillingAddress::with('getArea')->with('getCity')->with('getRegion')->with('getCountry')->where(['order_id' => $order->id])->first();
        $order_shipping_address  = OrderShippingAddress::with('getArea')->with('getCity')->with('getRegion')->with('getCountry')->where(['order_id' => $order->id])->first();
        $order_status_lists = OrderStatus::with('user')->where('order_id', $order->id)->get();
        return [
            'order' => $order,
            'product_details' => $product_details,
            'order_billing_address' => $order_billing_address,
            'order_shipping_address' => $order_shipping_address,
            'order_status_lists' => $order_status_lists,
        ];
    }

    public static function _change_status($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return -1;

        $model->is_active = ($model->is_active == 10 ? 0 : 10);
        $model->update();
        return $model->is_active;
    }

    public static function _format_for_csv($data)
    {
        $array_column_heading_names = [
            'A1' => 'Name',
            'B1' => 'Email',
            'C1' => 'Phone',
            'D1' => 'Status',
            'E1' => 'Created At',
        ];
        $array = [];
        if ($data) {
            $i = 1; // always start this from 1
            foreach ($data as $key => $row) {
                $i++;
                $array[$key]['A' . $i] = $row->name;
                $array[$key]['B' . $i] = $row->email;
                $array[$key]['C' . $i] = $row->phone ?? '-';
                $array[$key]['D' . $i] = ($row->status == 10) ? 'Active' : 'Inactive';
                $array[$key]['E' . $i] = $row->created_at;
            }
        }
        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }
}