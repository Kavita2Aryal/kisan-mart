<?php

namespace App\Observers\Ecommerce\Order;

use App\Models\Ecommerce\Order\OrderStatus;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class OrderStatusObserver
{
    public function created(OrderStatus $order_status)
    {
        $order_code = $order_status->order->order_code;
        $order_status_group = get_list_group('order-status');
        $status = $order_status_group[$order_status->status];
        LogService::queue('ready-made-order', $order_code . ' - ' . $status);
        cache()->flush();
    }
}
