<?php

namespace App\Models\Ecommerce\Offer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function alias()
    {
        return $this->hasOne('App\Models\Cms\WebAlias', 'offer_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Ecommerce\Product\Product', 'offer_products', 'offer_id', 'product_id')->orderBy('products.name');
    }

    // for seeder
    public function offer_products()
    {
        return $this->hasMany('App\Models\Ecommerce\Offer\OfferProduct', 'offer_id');
    }
}
