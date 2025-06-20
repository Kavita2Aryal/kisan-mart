<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    public function orders()
    {
        return $this->hasMany('App\Models\Ecommerce\Order\Order', 'customer_id', 'id');
    }

    public function cart_abandon()
    {
        return $this->hasMany('App\Models\Ecommerce\CheckoutStatus', 'customer_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
