<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\PromoCode\PromoCode;
use App\Models\Ecommerce\PromoCode\PromoCodeProduct;

use App\Helpers\Support;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Product\ProductVariant;
use App\Services\Ecommerce\PromoCodeService;
use Carbon\Carbon;
use Validator;
use Session;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'code'       => 'required',
            ]);
            if (!$validator->fails()) {
                if ($promo = PromoCode::where(['code'  => $request->code, 'is_active' => 10])->first()) {

                    $result = PromoCodeService::check($request, $promo);
                    if ($result['status'] == 'success') {
                        $promo->update();
                        return response()->json(['status' => 'success', 'promo_id' => $result['promo_id'], 'promo_discount' => $result['promo_discount'], 'sub_total' => $result['sub_total']], 200);
                    } else {
                        $validator->getMessageBag()->add($result['type'], $result['msg']);
                    }
                }
                $validator->getMessageBag()->add('no_code', 'Sorry, This code does not exists!');
            }
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
    }
}
