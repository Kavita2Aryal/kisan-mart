<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Customer;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class CustomerObserver
{
    public function creating(Customer $customer)
    {
        $customer->user_id = auth()->user()->id;
        $customer->uuid    = Str::uuid()->toString();
    }

    public function saved(Customer $customer)
    {
        if ($customer->wasRecentlyCreated) {
            LogService::queue('customer', $customer->name . ' - created');
            session()->flash('success', 'customer has been created.');
        } else if ($customer->isDirty('is_active') && count($customer->getDirty()) == 2) {
            LogService::queue('customer', $customer->name . ' - ' . ($customer->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('customer', $customer->name . ' - updated');
            session()->flash('success', 'customer has been updated.');
        }
        cache()->flush();
    }
}
