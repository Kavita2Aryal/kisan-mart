<?php

namespace App\Models\Ecommerce\Delivery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'deliveries';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function areas()
    {
        return $this->hasMany(DeliveryArea::class,'delivery_id');
    }


}
