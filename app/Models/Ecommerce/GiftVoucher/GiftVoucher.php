<?php

namespace App\Models\Ecommerce\GiftVoucher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftVoucher extends Model
{
    use HasFactory;

    protected $table = 'gift_vouchers';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function alias()
    {
        return $this->hasOne('App\Models\Cms\WebAlias', 'gift_voucher_id');
    }
}
