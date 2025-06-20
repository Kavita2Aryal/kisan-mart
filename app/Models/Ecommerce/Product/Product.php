<?php

namespace App\Models\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function product_categories()
    {
        return $this->hasMany('App\Models\Ecommerce\Product\ProductCategory', 'product_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Ecommerce\Brand', 'brand_id');
    }

    public function alias()
    {
        return $this->hasOne('App\Models\Cms\WebAlias', 'product_id');
    }

    public function variants()
    {
        return $this->hasMany('App\Models\Ecommerce\Product\ProductVariant', 'product_id');
    }

    public function product_combo()
    {
        return $this->hasMany('App\Models\Ecommerce\Product\ProductComboList', 'product_id');
    }

    public function default_variant()
    {
        return $this->hasOne('App\Models\Ecommerce\Product\ProductVariant', 'product_id')->where('is_default', 10);
    }

    public function other_variants()
    {
        return $this->hasMany('App\Models\Ecommerce\Product\ProductVariant', 'product_id')->where('is_default', 0);
    }

    public function seo()
    {
        return $this->hasOne('App\Models\Ecommerce\Product\ProductSeo', 'product_id');
    }

    public function gallery_images()
    {
        return $this->hasMany('App\Models\Ecommerce\Product\ProductImage', 'product_id')->where('is_thumb', 0)->whereNull('color_id');
    }

    public function thumbnail()
    {
        return $this->hasOne('App\Models\Ecommerce\Product\ProductImage', 'product_id')->where('is_thumb', 10);
    }

    public function offer()
    {
        return $this->hasOne('App\Models\Ecommerce\Offer\OfferProduct', 'product_id');
    }

    public function has_offer()
    {
        return $this->hasOne('App\Models\Ecommerce\Offer\OfferProduct', 'product_id', 'id')->join('offers', 'offers.id', '=', 'offer_products.offer_id');
    }
}
