<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Area;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class AreaObserver
{
    public function creating(Area $area)
    {
        $area->user_id = auth()->user()->id;
        $area->uuid    = Str::uuid()->toString();
    }

    public function saved(Area $area)
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
