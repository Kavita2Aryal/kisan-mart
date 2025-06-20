<?php

namespace App\Observers\Ecommerce\Order;

use App\Models\Ecommerce\Order\Order;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class OrderObserver
{
    public function created(Order $order)
    {
        $order_code = $order->order_code;
        $customer = $order->customer->name;
        $status = get_list_group('order-status')[$order->current_status];
        LogService::queue('order', $order_code . ' - has been created for - ' . $customer . ' with status - ', $status);
        cache()->flush();
    }
}
