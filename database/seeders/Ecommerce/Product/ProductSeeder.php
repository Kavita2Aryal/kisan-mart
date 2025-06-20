<?php

namespace Database\Seeders\Ecommerce\Product;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Product\ProductSeo;
use App\Models\Ecommerce\Product\ProductImage;
use App\Models\Ecommerce\Product\ProductSizeChartImage;
use App\Models\Ecommerce\Product\ProductVariant;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(100)->create()
        ->each(function ($product) {

            $product->seo()
                ->saveMany(ProductSeo::factory(1)->create([
                    'meta_title' => $product->title,
                    'product_id' => $product->id
                ]));

            $product->gallery_images()
                ->saveMany(ProductImage::factory(rand(1, 3))->create([
                    'product_id' => $product->id
                ]));

            $product->size_chart_images()
                ->saveMany(ProductSizeChartImage::factory(1)->create([
                    'product_id' => $product->id
                ]));
            
            $count = $product->has_variant == 10 ? rand(2, 3) : 1;

            $selling_price_array = [10000, 12000, 15000, 18000, 20000];
            $compare_price_array = [12000, 15000, 18000, 20000, 22000];
            $cost_price_array    = [8000, 10000, 12000, 15000, 18000];
            $start_price_array   = [10000, 12000, 15000, 18000, 20000];
            $end_price_array     = [15000, 18000, 20000, 24000, 25000];
            $index               = rand(0, 4);

            if ($product->type == 1) {
                $selling_price  = $selling_price_array[$index];
                $compare_price  = $compare_price_array[$index];
                $cost_price     = $cost_price_array[$index];
                $start_price    = 0;
                $end_price      = 0;
            }
            else if ($product->type == 2) {
                $selling_price  = 0;
                $compare_price  = 0;
                $cost_price     = 0;
                $start_price    = $start_price_array[$index];
                $end_price      = $end_price_array[$index];
            }
            
            $product->variants()
                ->saveMany(ProductVariant::factory($count)->create([
                    'product_id'    => $product->id,
                    'selling_price' => $selling_price,
                    'compare_price' => $compare_price,
                    'cost_price'    => $cost_price,
                    'start_price'   => $start_price,
                    'end_price'     => $end_price,
                ]));

        });
    }
}
