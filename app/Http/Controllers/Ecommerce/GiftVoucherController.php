<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\GiftVoucherRequest;
use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use App\Services\Ecommerce\GiftVoucherService;

class GiftVoucherController extends Controller
{
    public function index(Request $request)
    {
        $url = get_setting('website-domain');
        $gift_vouchers = GiftVoucherService::_paging($request);
        return view('modules.ecommerce.gift-voucher.index', compact('gift_vouchers', 'url'));
    }

    public function create()
    {
        $url = get_setting('website-domain');
        return view('modules.ecommerce.gift-voucher.create', compact('url'));
    }

    public function store(GiftVoucherRequest $request)
    {
        if (GiftVoucherService::_storing($request)) {
            return redirect()->route('gift.voucher.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create brand at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $gift_voucher = GiftVoucherService::_find($uuid);
        $url = get_setting('website-domain');
        return view('modules.ecommerce.gift-voucher.edit', compact('gift_voucher', 'url'));
    }

    public function update(GiftVoucherRequest $request, $uuid)
    {
        if (GiftVoucherService::_updating($request, $uuid)) {
            return redirect()->route('gift.voucher.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update brand at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = GiftVoucherService::_change_status($uuid);
        return response()->json($response, 200);
    }
}
