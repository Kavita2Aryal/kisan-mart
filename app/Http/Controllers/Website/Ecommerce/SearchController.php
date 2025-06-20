<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Ecommerce\SearchService;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        if($result = SearchService::_filter($request)){
            $search_request_parameter = $request->q;
            $products = $result['products'];
            $thumbnails = $result['thumbnails'];
            $sizes = $result['sizes'];
            $color_groups = $result['color_groups'];
            $brands = $result['brands'];
            $categories = $result['categories'];
            $offers = $result['offers'];
            $selected_collection_name = $result['selected_collection_name'];
            $selected_collection_type = $result['selected_collection_type'];
            $selected_category = $result['selected_category'];
            $show_filtered_category = $result['show_filtered_category'];
            $show_filtered_brand = $result['show_filtered_brand'];
            $show_filtered_size = $result['show_filtered_size'];
            $show_filtered_color = $result['show_filtered_color'];
            $show_filtered_sort = $result['show_filtered_sort'];
            $min_price = $result['min_price'];
            $max_price = $result['max_price'];
            return view('ecommerce.search.show', compact(
                                                        'search_request_parameter',
                                                        'products',
                                                        'thumbnails',
                                                        'sizes',
                                                        'color_groups',
                                                        'brands',
                                                        'categories',
                                                        'offers',
                                                        'selected_collection_name',
                                                        'selected_collection_type',
                                                        'selected_category',
                                                        'show_filtered_category',
                                                        'show_filtered_brand',
                                                        'show_filtered_size',
                                                        'show_filtered_color',
                                                        'show_filtered_sort',
                                                        'min_price',
                                                        'max_price'
                                                    ));
        }
        abort(404);
    }
}
