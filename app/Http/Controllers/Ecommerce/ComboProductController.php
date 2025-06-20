<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\ProductRequest;
use App\Models\Ecommerce\Product\Product;
use App\Services\Ecommerce\Product\ProductService;
use App\Services\Ecommerce\Product\ProductVariantService;
use App\Services\Ecommerce\BrandService;
use App\Services\Ecommerce\CategoryService;
use App\Services\Ecommerce\CollectionService;
use App\Services\Ecommerce\ColorService;
use App\Services\Ecommerce\SizeService;

use App\Services\General\ExportService;

class ComboProductController extends Controller
{
    public function index(Request $request)
    {
        $url = get_setting('website-domain');
        $products = ProductService::_paging($request, true);
        return view('modules.ecommerce.combo-product.index', compact('products', 'url'));
    }
    
    public function create()
    {
        $url = get_setting('website-domain');
        $uuid = 0;
        $categories = CategoryService::_get_parent();
        $brands = BrandService::_get();
        $colors = ColorService::_get();
        $sizes = SizeService::_get();
        $collection_types = get_list_group('collection-type');
        $collections = CollectionService::_get_by_type();
        return view('modules.ecommerce.combo-product.create', compact(
            'url',
            'uuid',
            'categories',
            'brands',
            'colors',
            'sizes',
            'collection_types',
            'collections',
        ));
    }

    public function store(ProductRequest $request)
    {
        if (ProductService::_storing($request, true)) {
            return redirect()->route('combo.product.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create product at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $product = ProductService::_find($uuid);
        $product_lists = [];
        foreach($product->product_combo as $row)
        {
            $product_lists[$row->product->id] = $row->product->name;
        }
        $url = get_setting('website-domain');
        $categories = CategoryService::_get_parent();
        $product_categories = ($product->product_categories != null) ? array_column($product->product_categories->toArray(), 'category_id') : [];
        $brands = BrandService::_get();
        $colors = ColorService::_get();
        $sizes = SizeService::_get();
        $collection_types = get_list_group('collection-type');
        $collections = CollectionService::_get_by_type();
        $default_variant = ($product->has_variant == 0) ? $product->default_variant : null;
        $details = ProductService::_get_variant_details($product);
        $selected_colors = $details['selected_colors'];
        $selected_sizes = $details['selected_sizes'];
        $color_image_arr = $details['color_image_arr'];
        $mockfiles = $details['mockfiles'];
        return view('modules.ecommerce.combo-product.edit', compact(
            'product',
            'url',
            'uuid',
            'categories',
            'product_categories',
            'brands',
            'colors',
            'sizes',
            'collection_types',
            'collections',
            'selected_colors',
            'selected_sizes',
            'default_variant',
            'color_image_arr',
            'mockfiles',
            'product_lists'
        ));
    }

    public function update(ProductRequest $request, $uuid)
    {
        if (ProductService::_updating($request, $uuid)) {
            return redirect()->route('combo.product.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update product at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = ProductService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function autosearch(Request $request)
    {
        return response()->json(ProductService::_autosearching($request));
    }

    public function check(Request $request, $uuid)
    {
        $name = $request->name;
        $model = Product::where('uuid', '!=', $uuid);
        $model->where(function ($query) use ($name) {
            $query->where(['name' => $name]);
        });

        if ($product = $model->first()) {
            if ($product->name == $request->name) {
                return response()->json(['data' => 'name']);
            }
        }
        return response()->json(['data' => false]);
    }

    public function get_details(Request $request)
    {
        if ($request->ajax()) {
            $product = ProductService::_find($request->uuid);
            $uuid = $product->uuid;
            $id = $product->id;
            $product_name = $product->name;
            $variation = ProductVariantService::_get_details($product->id);
            $type = $product->type == 1 ? 'ready-made' : 'custom';
            $has_variant = $product->has_variant;

            $html = view('modules.ecommerce.combo-product.quick-edit', compact('type', 'variation', 'uuid', 'id', 'product_name', 'has_variant'))->render();
            return response()->json(['status' => true, 'html' => $html]);
        }
        abort(404);
    }

    public function quick_update(Request $request, $uuid)
    {
        if (ProductVariantService::_quick_update($request)) {
            return redirect()->route('product.index')->with('success', 'The product price/qty has been updated.');
        }
        return back()->with('error', 'Sorry, could not update product at this time. Please try again later.');
    }

    public function export_csv()
    {
        $products = ProductService::_get(true);
        $products = ProductService::_format_for_csv($products);
        return ExportService::csv($products, 'products');
    }

    public function search(Request $request)
    {
        if ($products = ProductService::_searching($request)) {
            $html = view('modules.ecommerce.includes.searched-products', compact('products'))->render();
            return response()->json(['status' => true, 'html' => $html], 200);
        }
        return response()->json(['status' => false], 200);
    }
}
