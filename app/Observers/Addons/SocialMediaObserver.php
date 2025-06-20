<?php

namespace App\Observers\Addons;

use App\Models\Addons\SocialMedia;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class SocialMediaObserver
{
    public function creating(SocialMedia $social_media)
    {
        $social_media->user_id = auth()->user()->id;
        $social_media->uuid    = Str::uuid()->toString();
    }

    public function saved(SocialMedia $social_media)
    {
        if ($social_media->wasRecentlyCreated) {
            LogService::queue('social-media', $social_media->name . ' - created');
            session()->flash('success', 'Social Media has been created.');
        } else if ($social_media->isDirty('is_active') && count($social_media->getDirty()) == 2) {
            LogService::queue('social-media', $social_media->name . ' - ' . ($social_media->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('social-media', $social_media->name . ' - updated');
            session()->flash('success', 'Social Media has been updated.');
        }
        cache()->flush();
    }

    public function deleted(SocialMedia $social_media)
    {
        LogService::queue('social-media', $social_media->name . ' - deleted');
        session()->flash('success', 'Social Media has been deleted.');
        cache()->flush();
    }
}
