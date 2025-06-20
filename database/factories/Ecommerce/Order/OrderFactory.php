<?php

namespace Database\Factories\Ecommerce\Order;

use App\Models\Ecommerce\Order\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer_id = collect(Customer::where('is_active', 10)->pluck('id'))->random();
        return [
            'order_code'        => 'OC-R-'.time(),
            'uuid'              => Str::uuid()->toString(),
            'exchange_rate_id'  => 1,
            'customer_id'       => $customer_id,
            'sub_total'         => 0,
            'total'             => 0,
            'discount_amount'   => 0,
            'delivery_charge'   => 0,
            'vat_amount'        => 0,
            'current_status'    => 1,
            'payment_type'      => rand(1, 2) //$request->payment
        ];
        
    }
}
