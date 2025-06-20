<?php

namespace App\Models\Ecommerce\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function alias()
    {
        return $this->hasOne('App\Models\Cms\WebAlias', 'collection_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Ecommerce\Product\Product', 'collection_products', 'collection_id', 'product_id')->orderBy('products.name');
    }

    // for seeder
    public function collection_products()
    {
        return $this->hasMany('App\Models\Ecommerce\Collection\CollectionProduct', 'collection_id');
    }
}
