<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Policy;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class PolicyObserver
{
    public function creating(Policy $policy)
    {
        $policy->user_id = auth()->user()->id;
        $policy->uuid    = Str::uuid()->toString();
    }

    public function saved(Policy $policy)
    {
        if ($policy->wasRecentlyCreated) {
            LogService::queue('policy', $policy->title . ' - created');
            session()->flash('success', 'policy has been created.');
        } else if ($policy->isDirty('is_active') && count($policy->getDirty()) == 2) {
            LogService::queue('policy', $policy->title . ' - ' . ($policy->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('policy', $policy->title . ' - updated');
            session()->flash('success', 'policy has been updated.');
        }
        cache()->flush();
    }
}
