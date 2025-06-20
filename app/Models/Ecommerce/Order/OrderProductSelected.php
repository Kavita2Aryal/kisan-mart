<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductSelected extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'order_product_selected';

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_id');
    }

    public function variation()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\ProductVariant', 'product_sku', 'sku');
    }

    public function _formatting()
    {
        $variant = [];
        $categories = [];
        $product = $this->product;
        foreach($product->variants as $row)
        {
            $offer_price = get_offer_price($row->selling_price, ($product->has_offer != null ? $product->has_offer->toArray() : null));
            $variant[] = [
                'sku' => $row->sku,
                'variant' => $row->variant,
                'actual_price' => $row->selling_price,
                'price' => ($offer_price <= 0) ? $row->selling_price : $offer_price,
            ];
        }
        foreach($product->product_categories as $cat)
        {
            $categories[] = $cat->category->name;
        }
        return [
            'id' => $this->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'brand' => $product->brand->name,
            'categories' => $categories,
            'has_variant' => $product->has_variant,
            'variant' => $variant,
            'sku' => $this->product_sku,
            'qty' => $this->qty,
            'price' => $this->price,
            'actual_price' => $this->actual_price,
            'selected_variant' => $this->variation->variant
        ];
    }
}
