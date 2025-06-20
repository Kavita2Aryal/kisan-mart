<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

use App\Models\Ecommerce\Area;
use App\Models\Ecommerce\City;
use App\Models\General\User;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->unique()->streetName,
            'uuid'              => $this->faker->uuid,
            'city_id'           => collect(City::where('is_active', 10)->pluck('id'))->random(),
            'condition_amount'  => rand(20000, 25000),
            'delivery_charge'   => Arr::random([50, 100, 200]),
            'user_id'           => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'         => 10
        ];
    }
}
