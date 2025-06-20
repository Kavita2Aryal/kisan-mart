<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Addons\Faq;
use App\Models\Ecommerce\Product\ProductVariant;
use App\Models\Ecommerce\Wishlist;
use App\Models\Ecommerce\Product\Product;
use App\Services\Ecommerce\ProductQuestionAnswerService;
use App\Services\Ecommerce\ProductReviewService;
use Illuminate\Http\Request;

use OpenGraph;
use SEOMeta;
use Twitter;
use DB;
use Auth;

class ProductController extends Controller
{
    public function show()
    {
        if ($web = check_web_page_type(true)) {
            if ($web['status']) {
                $product_id = $web['web']->product_id;
                $data = cache()->remember('product_'.$product_id, config('app.addons_config.cache.24HR'), function () use($product_id) {
                        return Product::with(['alias', 'brand', 'category', 'default_variant.variant_color', 'default_variant.variant_size', 'variants.variant_color', 'variants.variant_size', 'variant_colors', 'variant_sizes', 'gallery_images', 'thumbnail', 'offer', 'question_answer.customer', 'question_answer.user'])->where(['id' => $product_id, 'is_active' => 10])->first();
                });
                if ($data) {
                    $wishlists = Auth::user() ? Wishlist::select('uuid', 'product_uuid')->where('customer_id', Auth::user()->id)->get()->toArray() : null;
                    $wishlist_products = $wishlists != null ? array_column($wishlists, 'uuid', 'product_uuid') : null;
                    $product = $data->_formating();
                    $brand_id = $data->brand_id;
                    $other_products = cache()->remember('other_product_'.$product_id, config('app.addons_config.cache.24HR'), function () use($product_id, $brand_id) {
                        return Product::with(['alias', 'default_variant.variant_color', 'default_variant.variant_size', 'thumbnail', 'offer'])->where('id', '!=', $product_id)->where('brand_id', $brand_id)->where('is_active', 10)->inRandomOrder()->limit(4)->get()->map->_other_formating();
                    });
                    $reviews = ProductReviewService::_get_reviews($product_id);
                    $avg_review = ProductReviewService::_get_avg_reviews($product_id);
                    $question_answers = ProductQuestionAnswerService::_get_data($product_id);
                    return view('ecommerce.product.show', compact('product', 'other_products', 'wishlist_products', 'reviews', 'avg_review', 'question_answers'));
                }
            }
        }
        abort(404);
    }
}
