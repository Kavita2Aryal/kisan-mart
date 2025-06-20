<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ColorGroup extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'color_groups';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function _format()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
