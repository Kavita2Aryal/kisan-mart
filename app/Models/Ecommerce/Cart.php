<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    public function customer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Customer', 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_uuid', 'uuid');
    }

    public function gift_voucher()
    {
        return $this->belongsTo('App\Models\Ecommerce\GiftVoucher\GiftVoucher', 'gift_voucher_uuid', 'uuid');
    }

    public function variation()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\ProductVariant', 'product_sku', 'sku');
    }
}
