<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Ecommerce\Country', 'country_id');
    }

    public function _format()
    {
        return [
            'key' => $this->id,
            'value' => $this->name,
            'country_id' => $this->country_id
        ];
    }
}
