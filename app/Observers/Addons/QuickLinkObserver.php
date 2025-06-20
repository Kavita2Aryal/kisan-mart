<?php

namespace App\Observers\Addons;

use App\Models\Addons\QuickLink;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class QuickLinkObserver
{
    public function creating(QuickLink $quick_link)
    {
        $quick_link->user_id = auth()->user()->id;
        $quick_link->uuid    = Str::uuid()->toString();
    }

    public function saved(QuickLink $quick_link)
    {
        if ($quick_link->wasRecentlyCreated) {
            LogService::queue('quick-link', $quick_link->name . ' - created');
            session()->flash('success', 'Quick Link has been created.');
        } else if ($quick_link->isDirty('is_active') && count($quick_link->getDirty()) == 2) {
            LogService::queue('quick-link', $quick_link->name . ' - ' . ($quick_link->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('quick-link', $quick_link->name . ' - updated');
            session()->flash('success', 'Quick Link has been updated.');
        }
        cache()->flush();
    }

    public function deleted(QuickLink $quick_link)
    {
        LogService::queue('quick-link', $quick_link->name . ' - deleted');
        session()->flash('success', 'Quick Link has been deleted.');
        cache()->flush();
    }
}
