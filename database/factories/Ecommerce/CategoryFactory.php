<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Ecommerce\Category;
use App\Models\General\User;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word;
        $parents = Category::where('is_active', 10)->where('parent_id', 0)->pluck('id');
        return [
            'name'          => $name,
            'slug'          => Str::slug($name, '-'),
            'uuid'          => $this->faker->uuid,
            'description'   => $this->faker->realText(rand(800, 2000)),
            'image'         => rand(1, 10) . '.jpg',
            'parent_id'     => $parents->count() > 0 ? collect($parents)->random() : 0,
            'user_id'       => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'     => 10
        ];
    }
}
