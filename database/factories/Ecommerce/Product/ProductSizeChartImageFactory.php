<?php

namespace Database\Factories\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\Product\ProductSizeChartImage;

class ProductSizeChartImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductSizeChartImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => rand(1, 10) . '.jpg'
        ];
    }
}
