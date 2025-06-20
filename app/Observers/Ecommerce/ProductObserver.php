<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Product\Product;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class ProductObserver
{
    public function creating(Product $product)
    {
        $product->user_id = auth()->user()->id;
        $product->uuid    = Str::uuid()->toString();
    }

    public function saved(Product $product)
    {
        if ($product->wasRecentlyCreated) {
            LogService::queue('product', $product->name . ' - created');
            session()->flash('success', 'product has been created.');
        } else if ($product->isDirty('out_of_stock') && count($product->getDirty()) == 2) {
            LogService::queue('product', $product->name . ' - ' . ($product->out_of_stock == 10 ? 'out of stock' : 'in stock'));
        } else {
            LogService::queue('product', $product->name . ' - updated');
            session()->flash('success', 'product has been updated.');
        }
        cache()->flush();
    }
}
