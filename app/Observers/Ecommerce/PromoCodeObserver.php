<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\PromoCode\PromoCode;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class PromoCodeObserver
{
    public function creating(PromoCode $promocode)
    {
        $promocode->user_id = auth()->user()->id;
        $promocode->uuid    = Str::uuid()->toString();
    }

    public function saved(PromoCode $promocode)
    {
        if ($promocode->wasRecentlyCreated) {
            LogService::queue('promocode', $promocode->code . ' - created');
            session()->flash('success', 'promocode has been created.');
        } else if ($promocode->isDirty('is_active') && count($promocode->getDirty()) == 2) {
            LogService::queue('promocode', $promocode->code . ' - ' . ($promocode->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('promocode', $promocode->code . ' - updated');
            session()->flash('success', 'promocode has been updated.');
        }
        cache()->flush();
    }
}
