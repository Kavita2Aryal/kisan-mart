<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class GiftVoucherObserver
{
    public function creating(GiftVoucher $gift_voucher)
    {
        $gift_voucher->user_id = auth()->user()->id;
        $gift_voucher->uuid    = Str::uuid()->toString();
    }

    public function saved(GiftVoucher $gift_voucher)
    {
        if ($gift_voucher->wasRecentlyCreated) {
            LogService::queue('Gift Voucher', $gift_voucher->name . ' - created');
            session()->flash('success', 'Gift Voucher has been created.');
        } else if ($gift_voucher->isDirty('is_active') && count($gift_voucher->getDirty()) == 2) {
            LogService::queue('Gift Voucher', $gift_voucher->name . ' - ' . ($gift_voucher->is_active == 10 ? 'published' : 'unpublished'));
        } else {
            LogService::queue('Gift Voucher', $gift_voucher->name . ' - updated');
            session()->flash('success', 'Gift Voucher has been updated.');
        }
        cache()->flush();
    }
}
