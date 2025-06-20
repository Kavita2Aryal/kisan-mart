<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Category;
use App\Services\Ecommerce\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryService::_get();
        return view('ecommerce.categories.index', compact('categories'));
    }

    public function show()
    {
        if ($web = check_web_page_type(true)) {
            if ($web['status']) {
                $category_id = $web['web']->category_id;
                $category = Category::where(['id' => $category_id, 'is_active' => 10, 'parent_id' => 0])->first();
                if ($category) {
                    $data = cache()->remember('category_'.$category_id, config('app.addons_config.cache.24HR'), function () use($category_id) {
                            return Category::with(['assign_products.product.thumbnail', 'assign_products.product.offer', 'assign_products.product.alias', 'assign_products.product.default_variant'])->where(['is_active' => 10, 'parent_id' => $category_id])->get()->map->_format();
                    });
                    return view('ecommerce.category.show', compact('data', 'category'));
                }
            }
        }
        abort(404);
    }
}