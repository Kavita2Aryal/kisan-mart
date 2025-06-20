<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Delivery\Delivery;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class DeliveryObserver
{

    public function creating(Delivery $delivery)
    {
        $delivery->user_id = auth()->user()->id;
        $delivery->uuid    = Str::uuid()->toString();
    }

    public function saved(Delivery $delivery)
    {
        if ($delivery->wasRecentlyCreated) {
            LogService::queue('delivery', $delivery->name . ' - created');
            session()->flash('success', 'Delivery has been created.');
        } else if ($delivery->isDirty('is_active') && count($delivery->getDirty()) == 2) {
            LogService::queue('delivery', $delivery->name . ' - ' . ($delivery->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('delivery', $delivery->name . ' - updated');
            session()->flash('success', 'Delivery has been updated.');
        }
        cache()->flush();
    }
}
