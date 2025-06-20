<?php

namespace App\Models\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ecommerce\Product\ProductImage;

class ProductVariant extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'product_variants';

    public function variant_size()
    {
        return $this->belongsTo('App\Models\Ecommerce\Size', 'size_id', 'id');
    }

    public function variant_color()
    {
        return $this->belongsTo('App\Models\Ecommerce\Color', 'color_id', 'id');
    }

    public function images()
    {
        return ProductImage::whereNotNull('color_id')->where(['product_id' => $this->product_id, 'color_id' => $this->color_id])->get();
    }
}
