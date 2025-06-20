<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'order_details';

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_id');
    }

    public function gift_voucher()
    {
        return $this->belongsTo('App\Models\Ecommerce\GiftVoucher\GiftVoucher', 'gift_voucher_id');
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

    public function _get_price()
    {
        return [
            'id'                    => $this->id,
            'sku'                   => $this->product_sku,
            'qty'                   => $this->qty,
            'price'                 => $this->price,
        ];
    }
}
