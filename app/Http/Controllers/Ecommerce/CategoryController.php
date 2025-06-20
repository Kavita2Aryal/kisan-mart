<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\CategoryRequest;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Product\ProductCategory;
use App\Services\Ecommerce\CategoryService;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $url = get_setting('website-domain');
        $categories = CategoryService::_paging($request);
        return view('modules.ecommerce.category.index', compact('categories', 'url'));
    }

    public function create()
    {
        $url = get_setting('website-domain');
        $categories = CategoryService::_get();
        return view('modules.ecommerce.category.create', compact('categories', 'url'));
    }

    public function store(CategoryRequest $request)
    {
        if (CategoryService::_storing($request)) {
            return redirect()->route('category.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create category at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $category = CategoryService::_find($uuid);
        $url = get_setting('website-domain');
        $categories = CategoryService::_get();
        $product_lists = [];
        foreach($category->assign_products as $row)
        {
            $product_lists[$row->product->id] = $row->product->name;
        }
        return view('modules.ecommerce.category.edit', compact('category', 'categories', 'url', 'product_lists'));
    }

    public function update(CategoryRequest $request, $uuid)
    {
        if (CategoryService::_updating($request, $uuid)) {
            return redirect()->route('category.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update category at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = CategoryService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function search(Request $request, $uuid)
    {
    	$data = [];
        $category = CategoryService::_find($uuid);
        if($request->has('q')){
            $search = $request->q;
            $data = Product::select(['products.id','products.name'])
                    ->join('product_categories as pcategory', 'pcategory.product_id', '=', 'products.id')
            		->where('products.name','LIKE',"%$search%")
                    ->where('pcategory.category_id', '=', $category->id)
                    ->where('products.is_active', 10)
            		->get();
        }
        return response()->json($data);
    }
}