<?php

namespace Database\Factories\Ecommerce\Collection;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Ecommerce\Collection\CollectionProduct;
use App\Models\Ecommerce\Product\Product;

class CollectionProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CollectionProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => collect(Product::where('is_active', 10)->pluck('id'))->random(),
        ];
    }
}
