<?php

namespace App\Services\Ecommerce\Order;

use App\Models\Ecommerce\Order\CancelOrderDetail;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\Product\Product;
use App\Services\Ecommerce\Product\ProductService;
use App\Services\Ecommerce\PromoCodeService;

use DB;

class OrderDetailService
{
    public static function _find($order_detail_id, $order_id)
    {
        return OrderDetail::where(['id' => $order_detail_id, 'order_id' => $order_id])->first();
    }

    public static function _get($order_id)
    {
        return OrderDetail::where(['order_id' => $order_id])->get();
    }

    public static function _remove_order_detail($req)
    {
        $model = self::_find($req->order_detail_id, $req->order_id);
        if ($model) {
            $xmodel                         = new CancelOrderDetail();
            $xmodel->order_id               = $model->order_id;
            $xmodel->product_id             = $model->product_id;
            $xmodel->product_sku            = $model->product_sku;
            $xmodel->qty                    = $model->qty;
            $xmodel->price                  = $model->price;
            $xmodel->remark                 = $req->remarks;

            if ($xmodel->save()) {
                $order              = Order::where('id', $req->order_id)->first();
                $temp = $model;
                if ($model->delete()) {
                    $response = self::_calculate_order_amount($order);
                    if ($response) {
                        return  [
                            'status' => true,
                            'order' => $order,
                            'message' => 'Order Detail has been removed',
                        ];
                    }
                }
            }
        }
        return  [
            'status' => false,
            'message' => 'Sorry, could not remove the order detail at this time. Please try again later.',
        ];
    }

    public static function _update_order_detail($req)
    {
        $model = self::_find($req->order_detail_id, $req->order_id);
        $abs_stock_qty  = abs($req->qty - $model->qty);
        $stock_qty      = ($req->qty - $model->qty);
        if ($model) {
            if ($abs_stock_qty != 0) {
                $model->qty = $req->qty;
                if ($model->update()) {
                    $order = Order::where('id', $req->order_id)->first();
                    $item_subtotal = $model->qty * $model->price;

                    $response = self::_calculate_order_amount($order);
                    if ($response) {
                        return  [
                            'status'    => true,
                            'order'     => $order,
                            'item_subtotal' => $item_subtotal,
                            'message'   => 'Order Detail has been updated',
                        ];
                    }
                }
            }
        }
        return  [
            'status' => false,
            'message' => 'Sorry, could not update the order detail at this time. Please try again later.',
        ];
    }

    public static function _save_order_detail($products, $uuid)
    {
        $order = Order::where('uuid', $uuid)->first();
        foreach($products as $key => $row){
            $batch[] = [
                'order_id' => $order->id,
                'product_id' => $key,
                'product_sku' => $row['sku'],
                'requested_qty' => $row['qty'],
                'qty' => $row['qty'],
                'price' => $row['price'],
                'actual_price' => $row['actual_price'],
            ];
        }
        if (isset($batch) && !empty($batch)) {
            OrderDetail::insert($batch);
        }
        $response = self::_calculate_order_amount($order);
        return $response;
    }

    public static function _calculate_order_amount($order)
    {
        $get_sub_total = OrderDetail::select(DB::raw("SUM(price*qty) as total_amount"))
            ->where('order_id', $order->id)->get();
    
        //calculate_subtotal
        $new_subtotal       = $get_sub_total[0]['total_amount'];
    
        // promocode calculate 
        $new_discount_amount = 0;
        if ($order->promo_code != null && $order->promo_code > 0) {
            $promocode = PromoCodeService::_calculate_promocode($order, $new_subtotal);
            if ($promocode) {
                $new_discount_amount = $promocode;
            }
        }
    
        $vat_applicable = get_setting('vat-applicable');
        $vat_amount = 0;
        $vat_percentage = null;
        if ($vat_applicable == "on") {
            $vat_percentage = get_setting('vat-rate');
            $vat_amount = $new_subtotal * ($vat_percentage / 100);
        }
    
        $grandtotal                 = $new_subtotal - $new_discount_amount + $order->delivery_charge + $vat_amount;
        $order->discount_amount     = $new_discount_amount;
        $order->sub_total           = $new_subtotal;
        $order->vat_rate            = $vat_percentage;
        $order->vat_amount          = $vat_amount;
        $order->total               = $grandtotal;
        if($order->update()){
            return true;
        }
        return false;
    }
}
