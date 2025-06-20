<?php

namespace App\Observers\Cms;

use App\Models\Cms\Slider;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class SliderObserver
{
    public function creating(Slider $slider)
    {
        $slider->user_id = auth()->user()->id;
        $slider->uuid    = Str::uuid()->toString();
    }

    public function saved(Slider $slider)
    {
        if ($slider->wasRecentlyCreated) {
            LogService::queue('slider', $slider->name . ' - created');
            session()->flash('success', 'Slider has been created.');
        } else if ($slider->isDirty('is_active') && count($slider->getDirty()) == 2) {
            LogService::queue('slider', $slider->name . ' - ' . ($slider->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('slider', $slider->name . ' - updated');
            session()->flash('success', 'Slider has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Slider $slider)
    {
        LogService::queue('slider', $slider->name . ' - deleted');
        session()->flash('success', 'Slider has been deleted.');
        cache()->flush();
    }
}
