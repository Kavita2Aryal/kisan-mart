<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Offer\Offer;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class OfferObserver
{
    public function creating(Offer $offer)
    {
        $offer->user_id = auth()->user()->id;
        $offer->uuid    = Str::uuid()->toString();
    }

    public function saved(Offer $offer)
    {
        if ($offer->wasRecentlyCreated) {
            LogService::queue('offer', $offer->name . ' - created');
            session()->flash('success', 'offer has been created.');
        }else if ($offer->isDirty('is_active') && count($offer->getDirty()) == 2) {
            LogService::queue('offer', $offer->name . ' - ' . ($offer->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('offer', $offer->name . ' - updated');
            session()->flash('success', 'offer has been updated.');
        }
        cache()->flush();
    }
}
