<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Ecommerce\City', 'city_id');
    }

    public function _format()
    {
        return [
            'key' => $this->id,
            'value' => $this->name,
            'delivery_charge' => $this->delivery_charge,
            'condition_amount' => $this->condition_amount,
            'city_id' => $this->city_id
        ];
    }
}
