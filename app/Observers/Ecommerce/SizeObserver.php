<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Size;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class SizeObserver
{
    public function creating(Size $size)
    {
        $size->user_id = auth()->user()->id;
        $size->uuid    = Str::uuid()->toString();
    }

    public function saved(Size $size)
    {
        if ($size->wasRecentlyCreated) {
            LogService::queue('size', $size->value . ' - created');
            session()->flash('success', 'size has been created.');
        } else if ($size->isDirty('is_active') && count($size->getDirty()) == 2) {
            LogService::queue('size', $size->name . ' - ' . ($size->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('size', $size->name . ' - updated');
            session()->flash('success', 'size has been updated.');
        }
        cache()->flush();
    }
}
