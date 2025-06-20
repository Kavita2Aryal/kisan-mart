<?php

namespace App\Models\Ecommerce\GiftVoucher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftVoucherSale extends Model
{
    use HasFactory;

    protected $table = 'gift_voucher_sales';

    protected $fillable = [
        'uuid', 'order_id', 'gift_voucher_uuid', 'verification_code'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Customer', 'customer_id');
    }

    public function gift_voucher()
    {
        return $this->belongsTo('App\Models\Ecommerce\GiftVoucher', 'gift_voucher_uuid', 'uuid');
    }

    public function gift_voucher_redemption()
    {
        return $this->hasMany('App\Models\Ecommerce\GiftVoucherRedemption', 'gift_voucher_sale_id', 'id');
    }

    public function get_total_redeemed_value()
    {
        return $this->gift_voucher_redemption()->sum('used_value');
    }

    public function check_fully_redeemed()
    {
        return $this->gift_voucher_redemption()->where('is_fully_redeemed', 10)->orderBy('created_at', 'DESC')->first();
    }
}
