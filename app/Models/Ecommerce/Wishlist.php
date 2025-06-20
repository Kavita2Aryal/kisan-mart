<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    public function customer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Customer', 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_uuid', 'uuid');
    }

    public static function _formating()
    {
        return [
            'product' => $this->product->name,
            'alias' => $this->product->alias->alias,
        ];
    }
}
