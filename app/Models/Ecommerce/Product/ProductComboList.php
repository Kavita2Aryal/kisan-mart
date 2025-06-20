<?php

namespace App\Models\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComboList extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'product_combo_lists';

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_combo_id', 'id');
    }
}
