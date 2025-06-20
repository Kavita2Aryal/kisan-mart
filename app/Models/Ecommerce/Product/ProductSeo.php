<?php

namespace App\Models\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSeo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_seos';

    protected $fillable = [
        'product_id', 'meta_title', 'meta_keywords', 'meta_description'
    ];
}
