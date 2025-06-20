<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\ExchangeRate;
use App\Models\General\User;

class ExchangeRateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExchangeRate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rate'          => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 150),
            'uuid'          => $this->faker->uuid,
            'user_id'       => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'     => 10
        ];
    }
}
