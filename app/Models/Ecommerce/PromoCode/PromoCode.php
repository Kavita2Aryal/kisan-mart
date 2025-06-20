<?php

namespace App\Models\Ecommerce\PromoCode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $table = 'promo_codes';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Ecommerce\Product\Product', 'promo_code_products', 'promo_code_id', 'product_id')->orderBy('products.name');
    }
}
