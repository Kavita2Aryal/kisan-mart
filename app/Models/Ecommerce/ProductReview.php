<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Customer', 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_id');
    }

    public function variation()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\ProductVariant', 'product_sku', 'sku');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\Order', 'order_id');
    }

    public function review_images()
    {
        return $this->hasMany('App\Models\Ecommerce\ProductReviewImage', 'product_review_id');
    }
}
