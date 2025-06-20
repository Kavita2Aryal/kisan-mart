<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Collection\Collection;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class CollectionObserver
{
    public function creating(Collection $collection)
    {
        $collection->user_id = auth()->user()->id;
        $collection->uuid    = Str::uuid()->toString();
    }

    public function saved(Collection $collection)
    {
        if ($area->wasRecentlyCreated) {
            LogService::queue('area', $area->name . ' - created');
            session()->flash('success', 'Area has been created.');
        } else if ($area->isDirty('is_active') && count($area->getDirty()) == 2) {
            LogService::queue('Area', $area->name . ' - ' . ($area->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('area', $area->name . ' - updated');
            session()->flash('success', 'Area has been updated.');
        }
        cache()->flush();
    }
}
