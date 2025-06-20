<?php

namespace Database\Factories\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

use App\Models\Ecommerce\Product\ProductVariant;
use App\Models\Ecommerce\Size;
use App\Models\Ecommerce\Color;
use App\Models\General\User;

class ProductVariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $is_default = 0; 
        $is_default++;

        $size  = collect(Size::where('is_active', 10)->get())->random();
        $color = collect(Color::where('is_active', 10)->get())->random();

        return [
            'sku'               => $this->faker->unique()->userName . $this->faker->unique()->userName,
            'qty'               => rand(1, 12),
            'size_id'           => $size->id,
            'color_id'          => $color->id,
            'variant'           => $color->name .' / '. $size->value,
            'is_default'        => $is_default == 0 ? 10 : 0,
            'is_active'         => 10
        ];
    }
}