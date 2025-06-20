<?php

namespace Database\Seeders\Ecommerce\Order;

use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\Order\OrderStatus;
use App\Models\Ecommerce\OrderBillingAddress;
use App\Models\Ecommerce\OrderShippingAddress;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(1)->create()
        ->each(function($order) {
            $order->details()
            ->saveMany(OrderDetail::factory(rand(1, 3))->create([
                'order_id' => $order->id,
            ]));

            $order->getStatuses()
            ->saveMany(OrderStatus::factory(1)->create([
                'order_id' => $order->id,
            ]));

            $order->billing()
            ->saveMany(OrderBillingAddress::factory(1)->create([
                'order_id' => $order->id,
            ]));

            $order->shipping()
            ->saveMany(OrderShippingAddress::factory(1)->create([
                'order_id' => $order->id,
            ]));

        });
        
    }
}
