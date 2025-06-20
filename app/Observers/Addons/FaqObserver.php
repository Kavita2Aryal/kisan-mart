<?php

namespace App\Observers\Addons;

use App\Models\Addons\Faq;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class FaqObserver
{
    public function creating(Faq $faq)
    {
        $faq->user_id = auth()->user()->id;
        $faq->uuid    = Str::uuid()->toString();
    }

    public function saved(Faq $faq)
    {
        if ($faq->wasRecentlyCreated) {
            LogService::queue('faq', $faq->question . ' - created');
            session()->flash('success', 'Faq has been created.');
        } else if ($faq->isDirty('is_active') && count($faq->getDirty()) == 2) {
            LogService::queue('faq', $faq->question . ' - ' . ($faq->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('faq', $faq->question . ' - updated');
            session()->flash('success', 'Faq has been updated.');
        }
        cache()->flush();
    }

    public function deleted(Faq $faq)
    {
        LogService::queue('faq', $faq->question . ' - deleted');
        session()->flash('success', 'Faq has been deleted.');
        cache()->flush();
    }
}
