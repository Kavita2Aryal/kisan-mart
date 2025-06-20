<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Currency;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class CurrencyObserver
{
    public function creating(Currency $currency)
    {
        $currency->user_id = auth()->user()->id;
        $currency->uuid    = Str::uuid()->toString();
    }

    public function saved(Currency $currency)
    {
        if ($currency->wasRecentlyCreated) {
            LogService::queue('currency', $currency->currency . ' - created');
            session()->flash('success', 'Currency has been created.');
        } else if ($currency->isDirty('is_active') && count($currency->getDirty()) == 2) {
            LogService::queue('currency', $currency->currency . ' - ' . ($currency->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('currency', $currency->currency . ' - updated');
            session()->flash('success', 'Currency has been updated.');
        }
        cache()->flush();
    }
}
