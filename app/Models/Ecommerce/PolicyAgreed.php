<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyAgreed extends Model
{
    use HasFactory;

    protected $table = 'policy_agreed';
    
    protected $fillable = [
        'customer_id', 'policy_id', 'agreed_on'
    ];

}
