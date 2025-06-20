<?php

namespace App\Observers\Cms;

use App\Models\Cms\Popup\Popup;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class PopupObserver
{
    public function creating(Popup $popup)
    {
        $popup->user_id = auth()->user()->id;
        $popup->uuid    = Str::uuid()->toString();
    }

    public function saved(Popup $popup)
    {
        if ($popup->wasRecentlyCreated) {
            LogService::queue('popup', $popup->title . ' - created');
            session()->flash('success', 'Popup has been created.');
        } else if ($popup->isDirty('is_active') && count($popup->getDirty()) == 2) {
            LogService::queue('popup', $popup->name . ' - ' . ($popup->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('popup', $popup->title . ' - updated');
            session()->flash('success', 'Popup has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Popup $popup)
    {
        LogService::queue('popup', $popup->title . ' - deleted');
        session()->flash('success', 'Popup has been deleted.');
        cache()->flush();
    }
}
