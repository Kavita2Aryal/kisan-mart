<?php

namespace App\Observers\Addons;

use App\Models\Addons\Blog\Blog;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class BlogObserver
{
    public function creating(Blog $blog)
    {
        $blog->user_id = auth()->user()->id;
        $blog->uuid    = Str::uuid()->toString();
    }

    public function saved(Blog $blog)
    {
        if ($blog->wasRecentlyCreated) {
            LogService::queue('blog', $blog->title . ' - created');
            session()->flash('success', 'Blog has been created.');
        } else if ($blog->isDirty('is_active') && count($blog->getDirty()) == 2) {
            LogService::queue('blog', $blog->title . ' - ' . ($blog->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('blog', $blog->title . ' - updated');
            session()->flash('success', 'Blog has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Blog $blog)
    {
        LogService::queue('blog', $blog->title . ' - deleted');
        session()->flash('success', 'Blog has been deleted.');
        cache()->flush();
    }

    public function restored(Blog $blog)
    {
        LogService::queue('blog', $blog->title . ' - restored');
        session()->flash('success', 'Blog has been restored.');
        cache()->flush();
    }
}
