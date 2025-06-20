<?php

namespace App\Observers\Addons;

use App\Models\Addons\Partner;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class PartnerObserver
{
    public function creating(Partner $partner)
    {
        $partner->user_id = auth()->user()->id;
        $partner->uuid    = Str::uuid()->toString();
    }

    public function saved(Partner $partner)
    {
        if ($partner->wasRecentlyCreated) {
            LogService::queue('partner', $partner->name . ' - created');
            session()->flash('success', 'Partner has been created.');
        } else if ($faq->isDirty('is_active') && count($faq->getDirty()) == 2) {
            LogService::queue('faq', $faq->question . ' - ' . ($faq->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('faq', $faq->question . ' - updated');
            session()->flash('success', 'Faq has been updated.');
        }
        cache()->flush();
    }
    
    public function deleted(Partner $partner)
    {
        LogService::queue('partner', $partner->name . ' - deleted');
        session()->flash('success', 'Partner has been deleted.');
        cache()->flush();
    }
}
