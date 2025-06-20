<?php

namespace App\Models\Ecommerce\Delivery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_id','area_id','day'];
}
