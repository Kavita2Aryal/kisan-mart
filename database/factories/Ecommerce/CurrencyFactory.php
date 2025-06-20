<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\Currency;
use App\Models\General\User;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency'      => $this->faker->unique()->currencyCode,
            'uuid'          => $this->faker->uuid,
            'user_id'       => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'     => 10
        ];
    }
}
