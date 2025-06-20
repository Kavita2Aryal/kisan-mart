<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\City;
use App\Models\Ecommerce\Region;
use App\Models\General\User;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->unique()->city,
            'uuid'              => $this->faker->uuid,
            'region_id'         => collect(Region::where('is_active', 10)->pluck('id'))->random(),
            'user_id'           => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'         => 10
        ];
    }
}
