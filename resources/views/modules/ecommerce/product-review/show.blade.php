@extends('layouts.app')

@section('title', 'Product Review Details')

@section('content')

<div class="container-fluid container-fixed-lg">
    <div class="row m-t-30">
        <div class="col-xl-3 col-lg-3">
            <h4>Product Review
                <a href="{{ route('product.review.index') }}" data-tippy-content="Go Back" data-tippy-placement="left" class="btn btn-link pull-right"><i class="pg-icon">arrow_left</i></a>
            </h4>
            <p>Product Review Details.</p>
        </div>
        <div class="col-xl-9 col-lg-9">
            <div class="card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Spam Count</p>
                                    </td>
                                    <td class="text-center"><h3>{{ $product_review->spam_count }}</h3></td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Status</p>
                                    </td>
                                    <td class="text-center">                        
                                        @if ($product_review->is_active == 10)
                                        <strong class="text-success">PUBLISHED<strong>
                                        @else
                                        <strong class="text-danger">UNPUBLISHED<strong>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Order Code</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->order->order_code }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Customer's Name</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->customer->name != null ? $product_review->customer->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Title</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->title != null ? $product_review->title : 'N/A'  }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Comment</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->comment != null ? $product_review->comment : 'N/A'   }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Product Name</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->product->name }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Rating Count</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->rating_count != null ? $product_review->rating_count : 'N/A' }}</td>
                                </tr>
                                @if($product_review->temp_comment != null)
                                <tr>
                                    <td class="">
                                        <p class="text-black">Updated Comment</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->temp_comment }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Updated Rating Count</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->temp_rating_count }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="">
                                        <p class="text-black">Created At</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->created_at }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Reply Status</p>
                                    </td>
                                    <td class="text-center">
                                        @if ($product_review->reply_status == 10)
                                        <strong class="text-success">Yes<strong>
                                        @else
                                        <strong class="text-danger">No<strong>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <p class="text-black">Reply</p>
                                    </td>
                                    <td class="text-center">{{ $product_review->reply != null ? $product_review->reply : 'N/A'  }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <br>
                    <div>
                        @if(count($product_review->review_images) > 0)
                            <p>Product Review Images</p>
                            <div class="row"> 
                                @foreach($product_review->review_images as $image)
                                    <div class="col-md-3">
                                        <img width="150" alt="" class="invoice-signature" data-src-retina="{{ url('storage/product-review/'.$image->image) }}" data-src="{{ url('storage/product-review/'.$image->image) }}" src="{{ url('storage/product-review/'.$image->image) }}">
                                    </div>
                                @endforeach 
                            </div>   
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection