<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Brand;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class BrandObserver
{
    public function creating(Brand $brand)
    {
        $brand->user_id = auth()->user()->id;
        $brand->uuid    = Str::uuid()->toString();
    }

    public function saved(Brand $brand)
    {
        if ($brand->wasRecentlyCreated) {
            LogService::queue('brand', $brand->name . ' - created');
            session()->flash('success', 'brand has been created.');
        } else if ($brand->isDirty('is_active') && count($brand->getDirty()) == 2) {
            LogService::queue('brand', $brand->name . ' - ' . ($brand->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('brand', $brand->name . ' - updated');
            session()->flash('success', 'brand has been updated.');
        }
        cache()->flush();
    }
}
