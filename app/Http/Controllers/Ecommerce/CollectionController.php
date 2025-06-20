<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\CollectionRequest;
use App\Services\Ecommerce\BrandService;
use App\Services\Ecommerce\CategoryService;
use App\Services\Ecommerce\CollectionService;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $url = get_setting('website-domain');
        $collection_types = get_list_group('collection-type');
        $collections = CollectionService::_paging($request);
        return view('modules.ecommerce.collection.index', compact('collections', 'url', 'collection_types'));
    }

    public function create()
    {
        $url = get_setting('website-domain');
        $collection_types = get_list_group('collection-type');
        return view('modules.ecommerce.collection.create', compact('url', 'collection_types'));
    }

    public function store(CollectionRequest $request)
    {
        if ($model = CollectionService::_storing($request)) {
            return redirect()->route('collection.manage', [$model->uuid])->with('success', 'collection has been created. You can now select the products via Manage Products.');
        }
        return back()->withInput()->with('error', 'Sorry, could not create collection at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $collection =  CollectionService::_find($uuid);
        $url = get_setting('website-domain');
        $collection_types = get_list_group('collection-type');
        return view('modules.ecommerce.collection.edit', compact('collection', 'url', 'collection_types'));
    }

    public function update(CollectionRequest $request, $uuid)
    {
        if ($model = CollectionService::_updating($request, $uuid)) {
            return redirect()->route('collection.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update collection at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = CollectionService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function manage(Request $request, $uuid)
    {
        $collection = CollectionService::_findWith($uuid);
        $categories = CategoryService::_get_parent();
        $brands = BrandService::_get();
        return view('modules.ecommerce.collection.manage', compact('collection', 'categories', 'brands'));
    }

    public function manage_save(Request $request, $uuid)
    {
        if (!$request->has('products')) {
            return back()->with('warning', 'Please add some products to the collection before submiting.');
        }
        CollectionService::_manage_saving($request, $uuid);
        return back()->with('success', 'Products has been added to the collection.');
    }

    public function remove_products(Request $request, $uuid)
    {
        if ($request->has('products')) {
            CollectionService::_remove_products($request->products, $uuid);
        }
        return response()->json(['status' => true], 200);
    }
}
