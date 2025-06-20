<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\ProductReview;

use DB;

class ProductReviewService
{
    public static function _find($uuid)
    {
        return ProductReview::with(['product', 'order', 'review_images', 'customer'])->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return ProductReview::with(['product', 'order', 'review_images', 'customer'])->orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = ProductReview::with(['product', 'order', 'review_images', 'customer'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _update($uuid)
    {
        $model = self::_find($uuid);
        $model->comment = $model->temp_comment;
        $model->rating_count = $model->temp_rating_count;
        $model->temp_comment = null;
        $model->temp_rating_count = 0;
        return $model->update() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return -1;

        $model->is_active = ($model->is_active == 10 ? 0 : 10);
        $model->update();
        return $model->is_active;
    }
}
