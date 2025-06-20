<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\ColorGroup;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class ColorGroupObserver
{
    public function creating(ColorGroup $color_group)
    {
        $color_group->user_id = auth()->user()->id;
        $color_group->uuid    = Str::uuid()->toString();
    }

    public function saved(ColorGroup $color_group)
    {
        if ($color_group->wasRecentlyCreated) {
            LogService::queue('color group', $color_group->name . ' - created');
            session()->flash('success', 'color group has been created.');
        } else if ($color_group->isDirty('is_active') && count($color_group->getDirty()) == 2) {
            LogService::queue('color group', $color_group->name . ' - ' . ($color_group->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('color group', $color_group->name . ' - updated');
            session()->flash('success', 'color group has been updated.');
        }
        cache()->flush();
    }
}
