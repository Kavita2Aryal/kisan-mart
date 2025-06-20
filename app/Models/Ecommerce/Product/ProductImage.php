<?php

namespace App\Models\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_images';

    protected $fillable = [
        'product_id', 'color_id', 'image', 'is_thumb'
    ];
}
