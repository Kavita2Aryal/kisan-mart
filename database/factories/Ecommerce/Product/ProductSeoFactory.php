<?php

namespace Database\Factories\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\Product\ProductSeo;

class ProductSeoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductSeo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meta_description'  => $this->faker->realText(rand(50, 100)),
            'meta_keywords'     => join(',', $this->faker->words(5, false)),
            'image'             => rand(1, 10) . '.jpg',
            'image_alt'         => $this->faker->realText(rand(15, 20)),
        ];
    }
}
