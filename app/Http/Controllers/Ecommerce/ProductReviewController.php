<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecommerce\ProductReview;
use App\Services\Ecommerce\ProductReviewService;

class ProductReviewController extends Controller
{

    public function index(Request $request)
    {
        $product_reviews = ProductReviewService::_paging($request);
        return view('modules.ecommerce.product-review.index',compact('product_reviews'));
    }

    public function show($uuid)
    {
        $product_review = ProductReviewService::_find($uuid);
        return view('modules.ecommerce.product-review.show', compact('product_review'));
    }

    public function update($uuid)
    {
        $response = ProductReviewService::_update($uuid);
        return response()->json($response, 200);
    }

    public function change_status($uuid)
    {
        $response = ProductReviewService::_change_status($uuid);
        return response()->json($response, 200);
    }
}
