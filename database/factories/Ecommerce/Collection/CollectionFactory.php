<?php

namespace Database\Factories\Ecommerce\Collection;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

use App\Models\Ecommerce\Collection\Collection;
use App\Models\General\User;

class CollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->unique()->word,
            'uuid'              => $this->faker->uuid,
            'description'       => $this->faker->realText(rand(800, 2000)),
            'image'             => rand(1, 10) . '.jpg',
            'user_id'           => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'         => 10
        ];
    }
}