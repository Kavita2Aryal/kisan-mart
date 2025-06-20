<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentFonepay extends Model
{
    use HasFactory;

    protected $table = 'payment_fonepay';

    protected $fillable = [
        'order_id', 'PRN', 'UID', 'BID', 'account', 'uniqueId', 'status'
    ];
}
