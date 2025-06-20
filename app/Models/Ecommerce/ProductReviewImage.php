<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviewImage extends Model
{
    use HasFactory;

    public function product_reviews()
    {
        return $this->belongsTo('App\Models\Ecommerce\ProductReview', 'product_review_id');
    }
}
