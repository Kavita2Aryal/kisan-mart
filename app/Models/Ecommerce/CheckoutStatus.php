<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutStatus extends Model
{
    use HasFactory;

    protected $table = 'checkout_status';

    public $timestamps = false;

    protected $fillable = [
        'customer_id', 'date'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Customer', 'customer_id');
    }
}
