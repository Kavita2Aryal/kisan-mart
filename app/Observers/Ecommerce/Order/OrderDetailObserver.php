<?php

namespace App\Observers\Ecommerce\Order;

use App\Models\Ecommerce\Order\OrderDetail;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class OrderDetailObserver
{
    public function updated(OrderDetail $order_detail)
    {
        $order_code = $order_detail->order->order_code;
        $product = $order_detail->product->name;
        $qty = $order_detail->qty;
        LogService::queue('order', $order_code . ' - ' . $product . ' - quantity updated to - ' . $qty);
        cache()->flush();
    }

    public function deleted(OrderDetail $order_detail)
    {
        $order_code = $order_detail->order->order_code;
        $product = $order_detail->product->name;
        LogService::queue('order', $order_code . ' - ' . $product . ' - removed');
        cache()->flush();
    }

    public function created(OrderDetail $order_detail)
    {
        $order_code = $order_detail->order->order_code;
        $product = $order_detail->product->name;
        $qty = $order_detail->qty;
        LogService::queue('order', $order_code . ' - ' . $product . ' -has been added with quantity ' . $qty);
        cache()->flush();
    }
}
