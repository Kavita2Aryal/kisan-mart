<?php

namespace App\Models\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_categories';

    protected $fillable = [
        'product_id', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Ecommerce\Category', 'category_id');
    }
}
