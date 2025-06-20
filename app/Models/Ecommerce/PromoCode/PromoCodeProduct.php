<?php

namespace App\Models\Ecommerce\PromoCode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCodeProduct extends Model
{
    use HasFactory;
    protected $table = 'promo_code_products';
    public $timestamps = false;
    protected $fillable = [
        'promo_code_id', 'product_id'
    ];

    public function promocode()
    {
        return $this->belongsTo('App\Models\Ecommerce\PromoCode\PromoCode',  'promo_code_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product',  'product_id');
    }
}
