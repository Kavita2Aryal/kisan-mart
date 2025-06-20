<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status';

    protected $fillable = [
        'order_id','status', 'is_active','remarks', 'user_id'
    ];
    
    public function order()
    {
        return $this->belongsTo('App\Models\Ecommerce\Order\Order', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
