<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Ecommerce\ProductReviewService;
use App\Http\Requests\ProductReviewRequest;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Product\ProductVariant;
use App\Models\Ecommerce\ProductReview;
use Auth;

class ProductReviewController extends Controller
{
    public function index()
    {
        $result = ProductReviewService::_get();
        $data = $result['products'];
        $reviews = $result['product_reviews'];
        return view('ecommerce.product-review.index', compact('data', 'reviews'));
    }

    public function product_review_store($uuid, $order_uuid)
    {
        if ($product = Product::where('uuid', $uuid)->firstOrFail()) {
            if($order = Order::select('id', 'order_code', 'created_at')->where('uuid', $order_uuid)->first()){
                $review = ProductReviewService::_find($order->id, $product->id);
                return view('ecommerce.product-review.review-store', compact('product', 'order', 'review'));
            }
        }
    }

    public function product_review_history()
    {
        $data = ProductReviewService::_product_review_history();
        return view('ecommerce.product-review.history', compact('data'));
    }

    public function save(ProductReviewRequest $request)
    {
        if (ProductReviewService::_save($request)) {
            return redirect()->route('product.review.history')->with('success-notify', 'Product review submitted successfully!');
        }
        return redirect()->back()->withInput()->with('error-notify', 'Sorry! Could not submit your review at the moment.');
    }
}
