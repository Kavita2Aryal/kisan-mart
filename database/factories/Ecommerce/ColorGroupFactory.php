<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\ColorGroup;
use App\Models\General\User;

class ColorGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ColorGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->unique()->safeColorName,
            'uuid'              => $this->faker->uuid,
            'value'             => $this->faker->unique()->hexcolor,
            'user_id'           => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'         => 10
        ];
    }
}
