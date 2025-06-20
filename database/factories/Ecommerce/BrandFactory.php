<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Ecommerce\Brand;
use App\Models\General\User;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->company;
        return [
            'name'          => $name,
            'slug'          => Str::slug($name, '-'),
            'uuid'          => $this->faker->uuid,
            'description'   => $this->faker->realText(rand(800, 2000)),
            'image'         => rand(1, 10) . '.jpg',
            'user_id'       => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'     => 10
        ];
    }
}
