<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function alias()
    {
        return $this->hasOne('App\Models\Cms\WebAlias', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Ecommerce\Category', 'parent_id')->where('is_active', 10);
    }

    public function child()
    {
        return $this->hasMany('App\Models\Ecommerce\Category', 'parent_id')->where('is_active', 10);
    }

    public function assign_products()
    {
        return $this->hasMany('App\Models\Ecommerce\CategoryAssignProduct', 'category_id');
    }
}
