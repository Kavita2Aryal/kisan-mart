<?php

namespace App\Models\Ecommerce\Offer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    use HasFactory;
    protected $table = 'offer_products';
    public $timestamps = false;
    protected $fillable = [
        'offer_id', 'product_id', 'discount', 'discount_type'
    ];

    public function offer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Offer\Offer', 'offer_id');
    }
}
