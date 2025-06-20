<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Country;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class CountryObserver
{
    public function creating(Country $country)
    {
        $country->user_id = auth()->user()->id;
        $country->uuid    = Str::uuid()->toString();
    }

    public function saved(Country $country)
    {
        if ($country->wasRecentlyCreated) {
            LogService::queue('country', $country->name . ' - created');
            session()->flash('success', 'Country has been created.');
        } else if ($country->isDirty('is_active') && count($country->getDirty()) == 2) {
            LogService::queue('country', $country->name . ' - ' . ($country->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('country', $country->name . ' - updated');
            session()->flash('success', 'country has been updated.');
        }
        cache()->flush();
    }
}
