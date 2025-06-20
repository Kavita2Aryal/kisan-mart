<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Ecommerce\Region', 'region_id');
    }

    public function _format()
    {
        return [
            'key' => $this->id,
            'value' => $this->name,
            'region_id' => $this->region_id
        ];
    }
}
