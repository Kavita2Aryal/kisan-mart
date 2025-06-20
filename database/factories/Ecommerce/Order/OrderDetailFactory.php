<?php

namespace Database\Factories\Ecommerce\Order;

use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Product\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $variant        = collect(ProductVariant::where('product_id', $product_id)->where('is_active', 10)->get())->random();
        $product_id     = collect(Product::where('is_active', 10)->where('type', 1)->pluck('id'))->random();
        $product_sku    = $variant->sku;
        $price          = $variant->selling_price;
        $qty            = rand(1, 5);
        return [
            'product_id'        => $product_id,
            'product_sku'       => $product_sku,
            'request_qty'       => $qty,
            'qty'               => $qty,
            'price'             => $price,
            'remarks'           => 0,
        ];
        
    }
}
