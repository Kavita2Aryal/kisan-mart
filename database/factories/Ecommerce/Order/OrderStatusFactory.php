<?php

namespace Database\Factories\Ecommerce\Order;

use App\Models\Ecommerce\Order\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class OrderStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status'            => 1,
            'is_active'         => 10,
            'user_id'           => null,
        ];
        
    }
}
