<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\Region;
use App\Models\Ecommerce\Country;
use App\Models\General\User;
use App\Models\Cms\ImageX;

class RegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Region::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->unique()->state,
            'country_id'    => collect(Country::where('is_active', 10)->pluck('id'))->random(),
            'uuid'          => $this->faker->uuid,
            'user_id'       => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'     => 10
        ];
    }
}
