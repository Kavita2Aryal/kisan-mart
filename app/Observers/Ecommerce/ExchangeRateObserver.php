<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\ExchangeRate;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class ExchangeRateObserver
{
    public function creating(ExchangeRate $exchange_rate)
    {
        $exchange_rate->user_id = auth()->user()->id;
        $exchange_rate->uuid    = Str::uuid()->toString();
    }

    public function saved(ExchangeRate $exchange_rate)
    {
        if ($exchange_rate->wasRecentlyCreated) {
            LogService::queue('exchange rate', $exchange_rate->currency->currency . ' - created');
            session()->flash('success', 'ExchangeRate has been created.');
        } else if ($exchange_rate->isDirty('is_active') && count($exchange_rate->getDirty()) == 2) {
            LogService::queue('exchange rate', $exchange_rate->currency->currency . ' - ' . ($exchange_rate->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('exchange rate', $exchange_rate->currency->currency . ' - updated');
            session()->flash('success', 'ExchangeRate has been updated.');
        }
        cache()->flush();
    }
}
