<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function _format()
    {
        return [
            'id' => $this->id,
            'name' => $this->value,
            'slug' => str_replace(' ', '', $this->value)
        ];
    }
}
