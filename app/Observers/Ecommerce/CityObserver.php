<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\City;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class CityObserver
{
    public function creating(City $city)
    {
        $city->user_id = auth()->user()->id;
        $city->uuid    = Str::uuid()->toString();
    }

    public function saved(City $city)
    {
        if ($city->wasRecentlyCreated) {
            LogService::queue('city', $city->name . ' - created');
            session()->flash('success', 'City has been created.');
        } else if ($city->isDirty('is_active') && count($city->getDirty()) == 2) {
            LogService::queue('city', $city->name . ' - ' . ($city->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('city', $city->name . ' - updated');
            session()->flash('success', 'city has been updated.');
        }
        cache()->flush();
    }
}
