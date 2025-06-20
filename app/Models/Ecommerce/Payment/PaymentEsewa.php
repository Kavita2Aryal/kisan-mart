<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentEsewa extends Model
{
    use HasFactory;

    protected $table = 'payment_esewa';

    protected $fillable = [
        'order_id', 'amt', 'refid'
    ];
}
