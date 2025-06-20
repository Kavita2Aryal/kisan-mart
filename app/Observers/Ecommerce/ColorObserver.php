<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Color;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class ColorObserver
{
    public function creating(Color $color)
    {
        $color->user_id = auth()->user()->id;
        $color->uuid    = Str::uuid()->toString();
    }

    public function saved(Color $color)
    {
        if ($color->wasRecentlyCreated) {
            LogService::queue('color', $color->name . ' - created');
            session()->flash('success', 'color has been created.');
        } else if ($color->isDirty('is_active') && count($color->getDirty()) == 2) {
            LogService::queue('color', $color->name . ' - ' . ($color->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('color', $color->name . ' - updated');
            session()->flash('success', 'color has been updated.');
        }
        cache()->flush();
    }
}
