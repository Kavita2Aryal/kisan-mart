<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\ProductReview;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class ProductReviewObserver
{
    public function updated(ProductReview $product_review)
    {
        if ($product_review->isDirty('is_active') && count($product_review->getDirty()) == 2) {
            LogService::queue('product review', $product_review->title . ' - ' . ($product_review->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('product', $product_review->title . ' - updated');
            session()->flash('message', 'Product Review has been updated.');
        }
    }
}
