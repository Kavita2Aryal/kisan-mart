<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\OfferRequest;
use App\Services\Ecommerce\BrandService;
use App\Services\Ecommerce\CategoryService;
use App\Services\Ecommerce\OfferService;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $url = get_setting('website-domain');
        $offers = OfferService::_paging($request);
        return view('modules.ecommerce.offer.index', compact('offers', 'url'));
    }

    public function create()
    {
        $url = get_setting('website-domain');
        $discount_types = get_list_group('discount-type');
        return view('modules.ecommerce.offer.create', compact('url', 'discount_types'));
    }

    public function store(OfferRequest $request)
    {
        if ($model = OfferService::_storing($request)) {
            return redirect()->route('offer.manage', [$model->uuid])->with('success', 'offer has been created. You can now select the products via Manage Products.');
        }
        return back()->withInput()->with('error', 'Sorry, could not create offer at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $offer =  OfferService::_find($uuid);
        $url = get_setting('website-domain');
        $discount_types = get_list_group('discount-type');
        return view('modules.ecommerce.offer.edit', compact('offer', 'url', 'discount_types'));
    }

    public function update(OfferRequest $request, $uuid)
    {
        if ($model = OfferService::_updating($request, $uuid)) {
            return redirect()->route('offer.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update Offer at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = OfferService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function manage(Request $request, $uuid)
    {
        $offer = OfferService::_findWith($uuid);
        $categories = CategoryService::_get();
        $brands = BrandService::_get();
        $discount_types = get_list_group('discount-type');
        return view('modules.ecommerce.offer.manage', compact('offer', 'categories', 'brands', 'discount_types'));
    }

    public function manage_save(Request $request, $uuid)
    {
        if (!$request->has('products')) {
            return back()->with('warning', 'Please add some products to the offer before submiting.');
        }

        OfferService::_manage_saving($request, $uuid);
        return back()->with('success', 'Products has been added to the offer.');
    }

    public function remove_products(Request $request, $uuid)
    {
        if ($request->has('products')) {
            OfferService::_remove_products($request->products, $uuid);
        }
        return response()->json(['status' => true], 200);
    }

    public function discount_update(Request $request, $uuid)
    {
        if (!$request->has('products')) {
            return response()->json(['status' => false], 200);
        }

        OfferService::_discount_updating($request, $uuid);
        return response()->json(['status' => true], 200);
    }
}
