<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function exchangeRate()
    {
        return $this->hasOne('App\Models\Ecommerce\ExchangeRate', 'currency_id', 'id')->where('is_active', 10);
    }
}
