<?php

namespace Database\Factories\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\Product\ProductImage;
use App\Models\Ecommerce\Color;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $is_thumb = 0; 
        $is_thumb++;

        return [
            'color_id' => $is_thumb != 0 ? collect(Color::pluck('id'))->random() : null,
            'is_thumb' => $is_thumb == 0 ? 10 : 0,
            'image'    => rand(1, 10) . '.jpg'
        ];
    }
}
