@extends('layout.app')
@section('title')
Product Review
@endsection
@push('seo')
@include('includes.seo.seo',
[
'seo' => null,
'url' => url()->current()
]
)
@endpush
@section('frontend-content')
@include('includes.cms.headers.header_1')

@include('includes.customer-nav',
[
'title' => 'Product Review'
]
)

@php
$domain = config('app.addons_config.domain');
@endphp

<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container">
            <div class="uk-child-width-expand@s" uk-grid>
                <div class="uk-grid-item-match">
                    <h2 class="uk-h1 uk-margin-small uk-text-left">Product Details</h2>
                    <div class="uk-margin">

                        <div class="uk-grid-match" uk-grid>
                            <div>
                                <div class="el-item uk-panel uk-margin-remove-first-child">
                                    <h4 class="uk-h4 uk-font-secondary">
                                        <a href="{!! $domain.'/'.$product->alias->alias !!}" target="_blank">{{ ucwords($product->name) }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid-match" uk-grid>
                            <div>
                                <div class="el-item uk-panel uk-margin-remove-first-child">
                                    <h4 class="uk-h4 uk-font-secondary">
                                        Order Code: {{ $order->order_code }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid-match" uk-grid>
                            <div>
                                <div class="el-item uk-panel uk-margin-remove-first-child">
                                    <h4 class="uk-h4 uk-font-secondary">
                                        Order Date: {{ date("M j, Y", strtotime($order->created_at)) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid-match" uk-grid>
                            <h4 class="uk-h4 uk-font-secondary">PRODUCT DESCRIPTION</h4>
                            <div>
                                <div class="el-item uk-panel uk-margin-remove-first-child">
                                    {{ $product->short_description }}
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid-match" uk-grid>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="uk-grid-item-match">
                    <form class="uk-form-stacked" action="{{ route('product.review.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input type="hidden" name="recaptcha" id="recaptcha">
                        <h2 class="uk-h1 uk-margin-small uk-text-left">@if($review != null) Edit a Review @else Add a Review @endif</h2>
                        <div class="uk-margin">
                            <div class="uk-child-width-1-2 uk-grid-match" uk-grid>
                                <div>
                                    <div class="el-item uk-panel uk-margin-remove-first-child">
                                        <h3 class="el-title uk-margin-top uk-margin-remove-bottom">Your Rating</h3>
                                    </div>
                                </div>
                                <div>
                                    <div class="el-item uk-panel uk-margin-remove-first-child">
                                        <div class="el-content uk-panel uk-margin-top">
                                            <fieldset class="rating uk-margin-remove">

                                                <input type="radio" id="star5" name="rating" value="5" @if($review != null && $review->rating_count == 5) checked @endif />
                                                <label class="full" for="star5" title="5 stars"></label>

                                                <input type="radio" id="star4half" name="rating" value="4.5" @if($review != null && $review->rating_count == 4.5) checked @endif />
                                                <label class="half" for="star4half" title="4.5 stars"></label>

                                                <input type="radio" id="star4" name="rating" value="4" @if($review != null && $review->rating_count == 4) checked @endif />
                                                <label class="full" for="star4" title="4 stars"></label>

                                                <input type="radio" id="star3half" name="rating" value="3.5" @if($review != null && $review->rating_count == 3.5) checked @endif />
                                                <label class="half" for="star3half" title="3.5 stars"></label>

                                                <input type="radio" id="star3" name="rating" value="3" @if($review != null && $review->rating_count == 3) checked @endif />
                                                <label class="full" for="star3" title="3 stars"></label>

                                                <input type="radio" id="star2half" name="rating" value="2.5" @if($review != null && $review->rating_count == 2.5) checked @endif />
                                                <label class="half" for="star2half" title="2.5 stars"></label>

                                                <input type="radio" id="star2" name="rating" value="2" @if($review != null && $review->rating_count == 2) checked @endif />
                                                <label class="full" for="star2" title="2 stars"></label>

                                                <input type="radio" id="star1half" name="rating" value="1.5" @if($review != null && $review->rating_count == 1.5) checked @endif />
                                                <label class="half" for="star1half" title="1.5 stars"></label>

                                                <input type="radio" id="star1" name="rating" value="1" @if($review != null && $review->rating_count == 1) checked @endif />
                                                <label class="full" for="star1" title="1 star"></label>

                                                <input type="radio" id="starhalf" name="rating" value="0.5" @if($review != null && $review->rating_count == 0.5) checked @endif />
                                                <label class="half" for="starhalf" title="0.5 stars"></label>
                                            </fieldset>
                                            @if ($errors->has('rating'))
                                            <span class="uk-text-danger" role="alert">
                                                <strong>{{ $errors->first('rating') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div>
                            <div class="uk-margin">
                                <label for="comment" class="uk-h3 uk-margin-remove">Your Review *</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="6" placeholder="" id="comment" name="comment">{{ $review->comment ?? '' }}</textarea>
                                    @if ($errors->has('comment'))
                                    <span class="uk-text-danger" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(config('services.recaptcha.key_v2'))
                                <div class="uk-margin">
                                    <div class="g-recaptcha" data-type="image" data-sitekey="{{config('services.recaptcha.key_v2')}}"></div>
                                    @if($errors->first('g-recaptcha-response'))
                                    <span class="uk-text-danger" role="alert">
                                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            @endif
                            <div class="uk-margin-medium">
                                <button type="submit" class="uk-button uk-button-default uk-button-large">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('includes.cms.footers.footer_1')
    @endsection

    @push('styles')
    @endpush

    @push('scripts')
    @endpush