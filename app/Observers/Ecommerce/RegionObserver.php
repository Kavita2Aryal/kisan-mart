<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Region;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class RegionObserver
{
    public function creating(Region $region)
    {
        $region->user_id = auth()->user()->id;
        $region->uuid    = Str::uuid()->toString();
    }

    public function saved(Region $region)
    {
        if ($region->wasRecentlyCreated) {
            LogService::queue('region', $region->name . ' - created');
            session()->flash('success', 'Region has been created.');
        } else if ($region->isDirty('is_active') && count($region->getDirty()) == 2) {
            LogService::queue('region', $region->name . ' - ' . ($region->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('region', $region->name . ' - updated');
            session()->flash('success', 'region has been updated.');
        }
        cache()->flush();
    }
}
