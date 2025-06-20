<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $table = 'exchange_rates';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
    public function currency()
    {
        return $this->belongsTo('App\Models\Ecommerce\Currency', 'currency_id');
    }
}
