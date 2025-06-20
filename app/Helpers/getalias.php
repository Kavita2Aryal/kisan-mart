<?php

use App\Http\Controllers\Addons\BlogController;
use App\Http\Controllers\Cms\PageController;
use App\Http\Controllers\Ecommerce\BrandController;
use App\Http\Controllers\Ecommerce\CategoryController;
use App\Http\Controllers\Ecommerce\CollectionController;
use App\Http\Controllers\Ecommerce\GiftVoucherController;
use App\Http\Controllers\Ecommerce\NewArrivalController;
use App\Http\Controllers\Ecommerce\OccasionController;
use App\Http\Controllers\Ecommerce\ProductController;
use App\Http\Controllers\Ecommerce\PromotionController;

if (!function_exists('get_web_page_type')) {

    function get_web_page_type($web)
    {
        if ($web == null) {
            $status = false;
            $action = '404';
            $class = '';
            $route_name = '';
        }
        else if ($web->page_id > 0) {
            $status = true;
            $class = PageController::class;
            $action = 'show';
            $route_name = 'page';
        } else if ($web->product_id > 0) {
            $status = true;
            $class = ProductController::class;
            $action = 'show';
            $route_name = 'product';
        } else if ($web->collection_id > 0) {
            $status = true;
            $class = CollectionController::class;
            $action = 'show';
            $route_name = 'collection';
        } else if ($web->category_id > 0) {
            $status = true;
            $class = CategoryController::class;
            $action = 'show';
            $route_name = 'category';
        } else if ($web->brand_id > 0) {
            $status = true;
            $class = BrandController::class;
            $action = 'show';
            $route_name = 'brand';
        } else if ($web->blog_id > 0) {
            $status = true;
            $class = BlogController::class;
            $action = 'show';
            $route_name = 'blog';
        }else if ($web->gift_voucher_id > 0) {
            $status = true;
            $class = GiftVoucherController::class;
            $action = 'show';
            $route_name = 'gift-voucher';
        }
        return ['status' => $status, 'action' => $action, 'class' => $class, 'route_name' => $route_name];
    }
}

if (!function_exists('get_alias_table_relation')) {

    function get_alias_table_relation()
    {
        return array(
            'page'          => ['table' => 'pages', 'relation' => 'page_id'],

            // addons
            'blog'          => ['table' => 'blogs', 'relation' => 'blog_id'],
            'news'          => ['table' => 'news', 'relation' => 'news_id'],
            'event'         => ['table' => 'events', 'relation' => 'event_id'],
            // addons
            
            // travel
            'package'       => ['table' => 'packages', 'relation' => 'package_id'],
            // travel
        );
    }
}