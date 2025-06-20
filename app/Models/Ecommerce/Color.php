<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function color_group()
    {
        return $this->belongsTo('App\Models\Ecommerce\ColorGroup', 'color_group_id');
    }

    public function _format()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => str_replace(' ', '', $this->name)
        ];
    }
}
