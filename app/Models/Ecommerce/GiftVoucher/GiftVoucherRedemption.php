<?php

namespace App\Models\Ecommerce\GiftVoucher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftVoucherRedemption extends Model
{
    use HasFactory;

    protected $table = 'gift_voucher_redemptions';

    public function sale()
    {
        return $this->belongsTo('App\Models\Ecommerce\GiftVoucherSale', 'gift_voucher_sale_id', 'id');
    }

}
