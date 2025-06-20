<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\Color;
use App\Models\Ecommerce\ColorGroup;
use App\Models\General\User;

class ColorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Color::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->unique()->colorName,
            'uuid'              => $this->faker->uuid,
            'value'             => $this->faker->unique()->hexcolor,
            'color_group_id'    => collect(ColorGroup::where('is_active', 10)->pluck('id'))->random(),
            'user_id'           => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'         => 10
        ];
    }
}
