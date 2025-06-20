<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Support;
use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use App\Models\Ecommerce\Wishlist;
use App\Services\Ecommerce\GiftVoucherService;
use App\Services\Ecommerce\ProductReviewService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class GiftVoucherController extends Controller
{
    public function index(Request $request)
    {
        $gift_vouchers = GiftVoucherService::_get($request);
        abort_if(!$gift_vouchers, 404);
        return view('ecommerce.gift-voucher.index', compact('gift_vouchers'));
    }

    public function show(Request $request)
    {
        if ($web = check_web_page_type(true)) {
            if ($web['status']) {
                $gift_voucher_id = $web['web']->gift_voucher_id;
                $data = cache()->remember('gift_voucher'.$gift_voucher_id, config('app.addons_config.cache.24HR'), function () use($gift_voucher_id) {
                        return GiftVoucher::with(['alias'])->where(['id' => $gift_voucher_id, 'is_active' => 10])->first();
                });
                if ($data) {
                    $wishlists = Auth::user() ? Wishlist::select('uuid', 'gift_voucher_uuid')->where('customer_id', Auth::user()->id)->get()->toArray() : null;
                    $wishlist_gift_vouchers = $wishlists != null ? array_column($wishlists, 'uuid', 'gift_voucher_uuid') : null;

                    $gift_voucher = $data->_formating();
                    $others = cache()->remember('others_'.$gift_voucher_id, config('app.addons_config.cache.24HR'), function () use($gift_voucher_id) { 
                        return GiftVoucher::with(['alias'])->where('id', '!=', $gift_voucher_id)->inRandomOrder()->limit(4)->get()->map->_formating();
                    });
                    return view('ecommerce.gift-voucher.show', compact('gift_voucher', 'others', 'wishlist_gift_vouchers'));
                }
            }
        }
        abort(404);
    }

    public function apply(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'code'       => 'required',
            ]);
            if (!$validator->fails()) {
                $result = GiftVoucherService::check($request);
                if ($result['status'] == 'success') {
                    return response()->json(['status' => 'success', 'gift_voucher_id' => $result['gift_voucher_id'], 'gift_voucher_sale_id' => $result['gift_voucher_sale_id'], 'gift_voucher_discount' => $result['gift_voucher_discount'], 'sub_total' => $result['sub_total']], 200);
                } else {
                    $validator->getMessageBag()->add($result['type'], $result['msg']);
                }
            }
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
    }
}
