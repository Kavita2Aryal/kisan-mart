<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'cancel_order_details';

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Ecommerce\Product\ProductImages', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\Order', 'order_id');
    }

    public function variation()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\ProductVariant', 'product_sku', 'sku');
    }

    public static function _get_detail($id)
    {
        $data_details   = self::with('product', 'product.images', 'product.thumbnail', 'product.alias')->where(['order_id' => $id])->get();
        return $data_details;
    }
}
