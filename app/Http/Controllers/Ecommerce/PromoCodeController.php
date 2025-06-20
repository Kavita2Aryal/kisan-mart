<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\PromoCodeRequest;

use App\Services\Ecommerce\PromoCodeService;
use App\Services\Ecommerce\BrandService;
use App\Services\Ecommerce\CategoryService;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        $url = get_setting('website-domain');
        $promocodes = PromoCodeService::_paging($request);
        return view('modules.ecommerce.promocode.index', compact('promocodes', 'url'));
    }

    public function create()
    {
        $url = get_setting('website-domain');
        return view('modules.ecommerce.promocode.create', compact('url'));
    }

    public function store(PromoCodeRequest $request)
    {
        if ($model = PromoCodeService::_storing($request)) {
            if ($request->type != 1 && $model) {
                return redirect()->route('promocode.manage', [$model->uuid])->with('success', 'promocode has been created. You can now select the products via Manage Products.');
            }
            return redirect()->route('promocode.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create promocode at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $promocode = PromoCodeService::_find($uuid);
        $url = get_setting('website-domain');
        return view('modules.ecommerce.promocode.edit', compact('promocode', 'url'));
    }

    public function update(PromoCodeRequest $request, $uuid)
    {
        if ($model = PromoCodeService::_updating($request, $uuid)) {
            return redirect()->route('promocode.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update promocode at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = PromoCodeService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function manage(Request $request, $uuid)
    {
        $promocode = PromoCodeService::_findWith($uuid);
        $categories = CategoryService::_get_parent();
        $brands = BrandService::_get();
        return view('modules.ecommerce.promocode.manage', compact('promocode', 'categories', 'brands'));
    }

    public function manage_save(Request $request, $uuid)
    {
        if (!$request->has('products')) {
            return back()->with('warning', 'Please add some products to the promo code before submiting.');
        }

        PromoCodeService::_manage_saving($request, $uuid);
        return back()->with('success', 'Products has been added to the promo code.');
    }

    public function remove_products(Request $request, $uuid)
    {
        if ($request->has('products')) {
            PromoCodeService::_remove_products($request->products, $uuid);
        }
        return response()->json(['status' => true], 200);
    }
}
