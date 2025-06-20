<?php

namespace App\Observers\Addons;

use App\Models\Addons\Testimonial;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class TestimonialObserver
{
    public function creating(Testimonial $testimonial)
    {
        $testimonial->user_id = auth()->user()->id;
        $testimonial->uuid    = Str::uuid()->toString();
    }
    
    public function saved(Testimonial $testimonial)
    {
        if ($testimonial->wasRecentlyCreated) {
            LogService::queue('testimonial', $testimonial->name . ' - created');
            session()->flash('success', 'Testimonial has been created.');
        } else if ($testimonial->isDirty('is_active') && count($testimonial->getDirty()) == 2) {
            LogService::queue('testimonial', $testimonial->name . ' - ' . ($testimonial->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('testimonial', $testimonial->name . ' - updated');
            session()->flash('success', 'Testimonial has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Testimonial $testimonial)
    {
        LogService::queue('testimonial', $testimonial->name . ' - deleted');
        session()->flash('success', 'Testimonial has been deleted.');
        cache()->flush();
    }
}
