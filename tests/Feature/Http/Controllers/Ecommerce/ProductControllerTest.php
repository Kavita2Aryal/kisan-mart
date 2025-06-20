<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Brand;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Color;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Size;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function product_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('product.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.product.create');
    }

    /** @test */
    public function product_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $name = $this->faker->name;

        $variants = [];
        $has_variant = Arr::random([0, 10]);
        if($has_variant == 10){
            for($i=0; $i<=2; $i++){
                $size  = collect(Size::where('is_active', 10)->get())->random();
                $color = collect(Color::where('is_active', 10)->get())->random();
                $variants[$i] = [
                    'qty'               => rand(1, 12),
                    'sku'               => null,
                    'size'           => $size->id,
                    'color'          => $color->id,
                    'variant'           => $color->name .' / '. $size->value,
                    'selling_price'     => rand(10000, 50000),
                    'compare_price'     => null,
                    'cost_price'        => rand(10000, 50000),
                    'is_default'        => $i == 0 ? 10 : 0,
                    'is_active'         => 10
                ];
            }
        }
        $product = [
            'name'                  => $name,
            'alias'                 => Str::slug($name, '-'),
            'short_description'     => $this->faker->realText(rand(800, 1000)),
            'long_description'      => $this->faker->realText(rand(800, 2000)),
            'video_url'             => 'https://youtu.be/fzGBRDpf5GU',
            'show_qty'              => Arr::random([0, 10]),
            'hit_count'             => 0,
            'purchase_count'        => 0,
            'category'              => collect(Category::where('is_active', 10)->pluck('id'))->random(),
            'brand'                 => collect(Brand::where('is_active', 10)->pluck('id'))->random(),
            'is_active'             => 10,
            'seo'                   => [
                'meta_title'       => $name,
                'meta_description' => $this->faker->realText(rand(800, 2000)),
                'meta_keywords'    => join(',', $this->faker->words(rand(3, 5))),
                'image_alt'        => 'product-seoimage.jpg',
            ],
            'thumbnail'             => 'product-thumbnail.jpg',
            'gallery'               => [
                0 => 'product-gallery1.jpg',
                1 => 'product-gallery2.jpg',
            ],
            'qty' => $has_variant == 0 ? rand(1, 12) : null,
            'selling_price' => $has_variant == 0 ? rand(10000, 50000) : null,
            'compare_price' => null,
            'cost_price' => $has_variant == 0 ? rand(10000, 50000) : null,
            'variants'  => $has_variant == 10 ? $variants : null
        ];
        if($has_variant == 10){
            $product = array_merge($product, ['has_variant' => 10]);
        }
        $response = $this->actingAs($user)->post(route('product.store'), $product);
        $response->assertRedirect(route('product.index'));
    }

    /** @test */
    public function product_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $product = Product::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('product.edit', $product->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.product.edit');
    }

    /** @test */
    public function product_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_product = Product::orderBy('id', 'DESC')->first();
        $variants = [];
        $has_variant = $db_product->has_variant;
        if($has_variant == 10){
            for($i=0; $i<=2; $i++){
                $size  = collect(Size::where('is_active', 10)->get())->random();
                $color = collect(Color::where('is_active', 10)->get())->random();
                $variants[$i] = [
                    'qty'               => rand(1, 12),
                    'sku'               => null,
                    'size'              => $size->id,
                    'color'             => $color->id,
                    'variant'           => $color->name .' / '. $size->value,
                    'selling_price'     => rand(10000, 50000),
                    'compare_price'     => null,
                    'cost_price'        => rand(10000, 50000),
                    'is_default'        => $i == 0 ? 10 : 0,
                    'is_active'         => 10
                ];
            }
        }
        $name = $this->faker->name;
        $product = [
            'name'                  => $name,
            'alias'                 => Str::slug($name, '-'),
            'short_description'     => $this->faker->realText(rand(800, 1000)),
            'long_description'      => $this->faker->realText(rand(800, 2000)),
            'video_url'             => 'https://youtu.be/fzGBRDpf5GU',
            'show_qty'              => Arr::random([0, 10]),
            'hit_count'             => 0,
            'purchase_count'        => 0,
            'category'              => $db_product->category_id,
            'brand'                 => $db_product->brand_id,
            'is_active'             => 10,
            'seo'                   => [
                'meta_title'       => $db_product->seo->meta_title,
                'meta_description' => $db_product->seo->meta_description,
                'meta_keywords'    => $db_product->seo->meta_keywords,
                'image_alt'        => 'product-seoimage.jpg',
            ],
            'thumbnail'             => 'product-thumbnail.jpg',
            'gallery'               => [
                0 => 'product-gallery1.jpg',
                1 => 'product-gallery2.jpg',
            ],
            'qty' => $has_variant == 0 ? rand(1, 12) : null,
            'selling_price' => $has_variant == 0 ? rand(10000, 50000) : null,
            'compare_price' => null,
            'cost_price' => $has_variant == 0 ? rand(10000, 50000) : null,
            'variants'  => $has_variant == 10 ? $variants : null
        ];
        if($has_variant == 10){
            $product = array_merge($product, ['has_variant' => 10]);
        }
        $response = $this->actingAs($user)->put(route('product.update', [$db_product->uuid]), $product);
        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function product_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $product = Product::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('product.change.status', [$product->uuid]));
        $response->assertStatus(200);
    }
}
