<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHbl extends Model
{
    use HasFactory;

    protected $table = 'payment_hbl';

    protected $fillable = [
        'order_id', 'status', 'amount', 'currency_code', 'invoice_no', 'tran_ref', 'approval_code', 'response_code', 'fraud_code', 'transaction_at'
    ];
}
