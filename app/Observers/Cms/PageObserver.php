<?php

namespace App\Observers\Cms;

use App\Models\Cms\Page\Page;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class PageObserver
{
    public function creating(Page $page)
    {
        $page->user_id = auth()->user()->id;
        $page->uuid    = Str::uuid()->toString();
    }

    public function saved(Page $page)
    {
        if ($page->wasRecentlyCreated) {
            LogService::queue('page', $page->name . ' - created');
            session()->flash('success', 'Page has been created.');
        } else if ($page->isDirty('is_active') && count($page->getDirty()) == 2) {
            LogService::queue('page', $page->name . ' - ' . ($page->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('page', $page->name . ' - updated');
            session()->flash('success', 'Page has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Page $page)
    {
        LogService::queue('page', $page->name . ' - deleted');
        session()->flash('success', 'Page has been deleted.');
        cache()->flush();
    }
}
