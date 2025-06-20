<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAssignProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'category_assign_products';

    protected $fillable = [
        'category_id', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_id');
    }
}
