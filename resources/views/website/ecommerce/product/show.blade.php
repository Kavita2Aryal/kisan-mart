@extends('layout.app')

@section('title')
{!! $product['name'] !!}
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

@php
$default_item = $product['default_variant'];
$currency = get_currency();
$rate = $currency->rate;
$review_count = count($reviews);
$avg_review_count = $avg_review[0]['avg_rating'];
$auth = (Auth::check() && Auth::user()->hasVerifiedEmail()) ? true : false;
$pricing = $product['pricing'];
$url = $_SERVER['REQUEST_URI'];
@endphp

<div class="uk-section-default uk-section uk-padding-remove-top product-item-main">
    <input type="hidden" class="product" value="{{ $product['uuid'] }}">
    <input type="hidden" class="qty" value="1">
    <input type="hidden" class="product-sku" value="{{ $default_item['sku'] }}">
    <input type="hidden" class="available-qty" value="{{  $default_item['qty'] }}">
    <input type="hidden" class="selected-size" value="{{ ($default_item['size'] != null ? $default_item['size'] : 0) }}">
    <input type="hidden" class="selected-color" value="{{ ($default_item['color'] != null ? $default_item['color'] : 0) }}">
    <input type="hidden" class="selected-size-id" value="{{ ($default_item['size'] != null ? $default_item['size_id'] : 0) }}">
    <input type="hidden" class="selected-color-id" value="{{ ($default_item['color'] != null ? $default_item['color_id'] : 0) }}">

    <div class="uk-margin-medium uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-grid-column-collapse uk-grid-row-large" uk-grid>
            <div class="uk-width-1-2@m">
                <div uk-slideshow="ratio: 1:1; minHeight: 500; animation: fade;" class="uk-margin-remove-vertical">
                    <div class="uk-position-relative">
                        <ul class="uk-slideshow-items">
                            @if($product['image'] != null && $product['image']['image'] != null)
                                @php $img = secure_img_product($product['image']['image'], 'main'); @endphp
                                <li class="el-item">
                                    <img src="{{ $img }}" class="el-image lozad" alt uk-cover/>
                                </li>
                            @else
                                <li class="el-item">
                                    <img
                                        src="{{ url('/storage/website/default.jpg') }}"
                                        class="el-image lozad"
                                        alt
                                        uk-cover
                                    />
                                </li>
                            @endif
                            @if($product['gallery_images']->count() > 0)
                                @foreach($product['gallery_images'] as $key => $gallery_img)
                                    @if($gallery_img['image'] != null)
                                        @php $img = secure_img_product($gallery_img['image'], 'main'); @endphp
                                        <li class="el-item">
                                            <img src="{{ $img }}" class="el-image lozad" alt uk-cover />
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <ul class="el-nav uk-thumbnav uk-flex-nowrap uk-flex-center uk-margin-top" uk-margin>
                        @if($product['image'] != null && $product['image']['image'] != null)
                            @php $img = secure_img_product($product['image']['image'], 'main'); @endphp
                            <li uk-slideshow-item="0">
                                <a href="{{ $img }}">
                                    <img src="{{ $img }}" class="lozad thumbimg" alt />
                                </a>
                            </li>
                        @else
                            <li uk-slideshow-item="0">
                                <a href="{{ url('/storage/website/default.jpg') }}">
                                    <img src="{{ url('/storage/website/default.jpg') }}" class="lozad thumbimg" alt />
                                </a>
                            </li>
                        @endif
                        @if($product['gallery_images']->count() > 0)
                            @php $i = 0; @endphp
                            @foreach($product['gallery_images'] as $key => $gallery_img)
                                @php $i++; @endphp
                                @if($gallery_img['image'] != null)
                                    @php $img = secure_img_product($gallery_img['image'], 'main'); @endphp
                                    <li uk-slideshow-item="{{ $i }}">
                                        <a href="{{ $img }}">
                                            <img src="{{ $img }}" class="lozad thumbimg" alt />
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="uk-grid-item-match uk-width-1-2@m">
                <div class="uk-tile-default uk-tile uk-flex uk-flex-middle">
                    <div class="uk-panel uk-width-1-1">
                        <div class="uk-h6 uk-text-muted uk-margin-remove-vertical uk-width-xlarge uk-margin-auto@m uk-text-left">{{ $product['brand'] }}</div>
                        <h1 class="uk-h2 uk-margin uk-width-xlarge uk-margin-auto@m uk-text-left">{!! $product['name'] !!}</h1>
                        @if($pricing != null && $pricing->current_offer != null)
                        <div class="uk-h3 uk-margin-remove-vertical uk-width-xlarge uk-margin-auto@m uk-text-left money-show-container">
                            {!! $currency->name . ' ' . number_format(($pricing->current_price/$rate), 2) !!}<br>
                            <s>{!! $currency->name . ' ' . number_format(($pricing->original_price/$rate), 2) !!}</s>
                            @if($pricing->discount_rate > 0)
                            <span class="uk-text-italic uk-text-light uk-text-discount">-{{ $pricing->discount_rate }} %</span>
                            @endif
                        </div>
                        @else
                        <div class="uk-h3 uk-margin-remove-vertical uk-width-xlarge uk-margin-auto@m uk-text-left money-show-container">
                            {!! $currency->name . ' ' . number_format(($default_item['selling_price']/$rate),2) !!}
                        </div>
                        @endif
                        <div class="uk-margin-medium uk-width-xlarge@m uk-margin-auto">
                            {!! $product['short_description'] !!}
                            {!! $product['long_description'] !!}
                        </div>
                        @php $style="display:none" ;@endphp
                        @if($default_item['qty'] < 0 || $default_item['qty']==0) @php $style="display:block" ;@endphp @endif
                        <span class="uk-h3 uk-margin uk-text-italic uk-text-danger stock-out" style="display:none">OUT OF STOCK</span>
                        @if($product['has_variant'] == 10)
                            @php
                            $default_color = $default_item['color'];
                            $default_size = $default_item['size'];
                            @endphp
                            @if($product['variant_sizes'] != null && $product['variant_sizes']->count() > 0 && $product['variant_sizes'][0]['size_id'] != null)
                            <div class="uk-margin uk-width-xlarge@m uk-margin-auto">
                            <p class="uk-margin-small uk-text-meta">SIZES</p>
                                <div class="size-box uk-margin-small uk-text-center">
                                    <div class="uk-child-width-auto uk-grid-small uk-grid-match" uk-grid>
                                        @foreach($product['variant_sizes'] as $key => $size)
                                        @if($size->size_id != null)
                                        <div>
                                            <a class="size-box el-item uk-panel uk-margin-remove-first-child uk-link-toggle uk-display-block product-size" href="javascript:void(0);" id="product-size-{{$size->variant_size->id}}" data-id="{{ $size->variant_size->id }}" data-name="{{ $size->variant_size->value }}">
                                                <div class="el-title uk-margin-top uk-margin-remove-bottom" style="padding: 0 20px;">
                                                    {{ ucwords($size->variant_size->value) }}
                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($product['variant_colors'] != null && $product['variant_colors']->count() > 0 && $product['variant_colors'][0]['color_id'] != null)
                            <div class="uk-margin uk-width-xlarge@m uk-margin-auto">
                                <h6 class="uk-margin-remove-bottom">COLOR</h6>
                                <div class="size-box uk-margin-small uk-text-center">
                                    <div class="uk-child-width-auto uk-grid-small uk-grid-match" uk-grid>
                                        @foreach($product['variant_colors'] as $key => $color)
                                        @if($color->color_id != null)
                                        <div>
                                            <a class="el-item uk-panel uk-margin-remove-first-child uk-link-toggle uk-display-block product-color" href="javascript:void(0);" id="product-color-{{$color->variant_color->id}}" data-id="{{ $color->variant_color->id }}" data-name="{{ $color->variant_color->name }}">
                                                <div class="el-title uk-margin-top uk-margin-remove-bottom" style="padding: 0 10px;">
                                                    {{ ucwords($color->variant_color->name) }}
                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                        @php $style = 'display:block'; @endphp
                        @if($product['out_of_stock'] == 10) @php $style="display:none" ;@endphp @endif
                        <div class="uk-margin uk-width-xlarge@m uk-margin-auto">
                            <div class="quantity-container" style="display:block;">
                                <p class="uk-margin-small uk-text-meta">QUANTITY</p>
                                <div class="uk-margin-small">
                                    <div class="qtyselector">
                                        <div class="uk-grid-collapse uk-child-width-auto uk-text-center" uk-grid>
                                            <div>
                                                <a class="minus qty-subtract-product" href="javascript:void(0);">-</a>
                                            </div>
                                            <div>
                                                <div class="qty"><input class="uk-input show-qty" type="text" value="1" readonly /></div>
                                            </div>
                                            <div>
                                                <a class="plus qty-add-product" href="javascript:void(0);">+</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid-small uk-width-xlarge uk-margin-auto paddingremove" uk-grid>
                            <div class="uk-width-1-2@s">
                                <div class="uk-margin uk-width-xlarge@m uk-margin-auto parent-wishlist-button">
                                    <a href="javascript:void(0);" class="el-content uk-button uk-width-1-1 uk-button-default @if(Auth::user()) add-to-wishlist @endif" @if(!Auth::user()) uk-toggle="target: #wishlist-modal" @endif style="{{ ($wishlist_products != null && array_key_exists($product['uuid'], $wishlist_products)) ? 'display:none' : '' }}">
                                        <span uk-icon="heart" class="uk-icon"></span>
                                        <span class="uk-text-middle uk-margin-small-left">ADD TO WISHLIST</span>
                                    </a>
                                    <a href="javascript:void(0);" class="el-content uk-button uk-width-1-1 uk-button-default remove-from-wishlist" data-uuid="{{ (($wishlist_products != null) && isset($wishlist_products[$product['uuid']])) ? $wishlist_products[$product['uuid']] : '' }}" style="{{ (($wishlist_products == null) || ($wishlist_products != null && !array_key_exists($product['uuid'], $wishlist_products))) ? 'display:none' : '' }}">
                                        <span uk-icon="heart" class="uk-icon"></span>
                                        <span class="uk-text-middle uk-margin-small-left">REMOVE FROM WISHLIST</span>
                                    </a>
                                </div>
                            </div>
                            @if($product['out_of_stock'] == 0)
                                <div class="uk-width-1-2@s">
                                    <div class="uk-margin uk-width-xlarge@m uk-margin-auto cart-functional-buttons add-button">
                                        <a class="el-content uk-width-1-1 uk-button uk-button-secondary @if(Auth::user()) add-to-cart @endif" href="javascript:void(0);" @if(!Auth::user()) uk-toggle="target: #cart-modal" @endif>
                                            Add to Cart
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="uk-width-1-2@s">
                                    <div class="uk-margin uk-width-xlarge@m uk-margin-auto cart-functional-buttons add-button">
                                        <a class="el-content uk-width-1-1 uk-button uk-button-danger" href="javascript:void(0);">
                                            Out Of Stock
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="uk-margin uk-width-xlarge@m uk-margin-auto cart-functional-buttons buy-button" style="{{ $style }}">
                            <a class="el-content uk-width-1-1 uk-button uk-button-danger @if(Auth::user()) direct-checkout @endif" href="javascript:void(0);" @if(!Auth::user()) uk-toggle="target: #checkout-modal" @endif data-now="1" data-product-uuid="{{ $product['uuid'] }}">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div id="wishlist-modal" uk-modal class="uk-flex-top uk-modal">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-text-center">
            <button class="uk-modal-close-default uk-icon uk-close" uk-close=""></button>

            <img src="{{ url('storage/website/wishlist.svg' ) }}" style="width: 120px;" />
            <h3 class="uk-text-center uk-h3">You need to be logged in to add this product in your wishlist</h3>

            <a href="{{ route('login') }}" class="uk-button uk-button-default uk-margin-small-top" aria-="" rel="nofollow">LOGIN</a>
            <a href="javascript:void(0)" class="uk-button uk-button-primary uk-modal-close uk-margin-small-top">Cancel</a>
        </div>
    </div>
</div>
<div>
    <div id="cart-modal" uk-modal class="uk-flex-top uk-modal">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-text-center">
            <button class="uk-modal-close-default uk-icon uk-close" uk-close=""></button>

            <img src="{{ url('storage/website/cart.svg' ) }}" style="width: 120px;" />
            <h3 class="uk-text-center uk-h3">You need to be logged in to add this product in your cart</h3>

            <a href="{{ route('login') }}" class="uk-button uk-button-default uk-margin-small-top" aria-="" rel="nofollow">LOGIN</a>
            <a href="javascript:void(0)" class="uk-button uk-button-primary uk-modal-close uk-margin-small-top">Cancel</a>
        </div>
    </div>
</div>
<div>
    <div id="checkout-modal" uk-modal class="uk-flex-top uk-modal">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-text-center">
            <button class="uk-modal-close-default uk-icon uk-close" uk-close=""></button>

            <img src="{{ url('storage/website/cart.svg' ) }}" style="width: 120px;" />
            <h3 class="uk-text-center uk-h3">You need to be logged in to buy the product</h3>

            <a href="{{ route('login') }}" class="uk-button uk-button-default uk-margin-small-top" aria-="" rel="nofollow">LOGIN</a>
            <a href="javascript:void(0)" class="uk-button uk-button-primary uk-modal-close uk-margin-small-top">Cancel</a>
        </div>
    </div>
</div>
@if($product['video_url'] != null)
<div class="uk-section-muted uk-section">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container uk-container-small">
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div>
                    <div class="uk-margin">
                        @php $video = get_youtube_video_id($product['video_url']); $url = "https://www.youtube.com/embed/".$video; @endphp
                        <iframe src="{{ $url }}" frameborder="0" allowfullscreen uk-responsive width="1920" height="1080"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="uk-section-default uk-section uk-section-xlarge" style="display:none;">
    <div class="uk-container uk-container-expand">
        <div class="tm-grid-expand uk-grid-collapse" uk-grid>
            <div class="uk-grid-item-match uk-width-1-4@m uk-visible@m">
                <div class="uk-panel uk-width-1-1">
                    <div id="page#2-0-0-0" class="uk-visible@m uk-position-absolute uk-width-1-1 uk-text-left" uk-parallax="y: 0,-10vh; media: @m;" style="right: 4vw; top: -5vh;">
                        <img src="{{ url('/storage/website/illustration-sun.svg') }}" class="el-image" alt target="!*" />
                    </div>
                </div>
            </div>

            <div class="uk-width-1-2@m">
                <h2 class="uk-h3 uk-width-xlarge uk-margin-auto uk-text-left@m uk-text-center">Frequently Asked Questions</h2>
                <div uk-accordion="multiple: 1; collapsible: true;" class="uk-margin-large uk-width-xlarge uk-margin-auto">
                    <div class="el-item">
                        <a class="el-title uk-accordion-title" href="4-product-page.html#">Where Do the Materials Come From?</a>

                        <div class="uk-accordion-content uk-margin-remove-first-child">
                            <div class="el-content uk-panel uk-margin-top">
                                Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar.
                            </div>
                        </div>
                    </div>
                    <div class="el-item">
                        <a class="el-title uk-accordion-title" href="4-product-page.html#">Do I Have Any Guarantee?</a>

                        <div class="uk-accordion-content uk-margin-remove-first-child">
                            <div class="el-content uk-panel uk-margin-top">
                                Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar.
                            </div>
                        </div>
                    </div>
                    <div class="el-item">
                        <a class="el-title uk-accordion-title" href="4-product-page.html#">What Is so Special About Balou Products?</a>

                        <div class="uk-accordion-content uk-margin-remove-first-child">
                            <div class="el-content uk-panel uk-margin-top">
                                Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid-item-match uk-flex-bottom uk-width-1-4@m uk-visible@m">
                <div class="uk-panel uk-width-1-1">
                    <div id="page#2-0-2-0" class="uk-visible@m uk-position-absolute uk-width-1-1 uk-text-center" uk-parallax="y: -5vh,-18vh;" style="top: -2vh;">
                        <img src="{{ url('/storage/website/illustration-blueberries.svg') }}" class="el-image" alt target="!*" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-section uk-section-xlarge uk-padding-remove-top" style="display:none;">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-text-center">
                    <div class="uk-child-width-1-2 uk-child-width-1-4@s uk-child-width-1-4@m uk-grid-large uk-grid-match" uk-grid>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                <img src="{{ url('/storage/website/knitted-baby-suit-benefits-01.svg') }}" class="el-image uk-text-emphasis" alt uk-svg />

                                <h2 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom">Fast Delivery</h2>
                            </div>
                        </div>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                <img src="{{ url('/storage/website/knitted-baby-suit-benefits-02.svg') }}" class="el-image uk-text-emphasis" alt uk-svg />

                                <h2 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom">Made With Love</h2>
                            </div>
                        </div>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                <img src="{{ url('/storage/website/knitted-baby-suit-benefits-03.svg') }}" class="el-image uk-text-emphasis" alt uk-svg />

                                <h2 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom">Happy Customers</h2>
                            </div>
                        </div>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                <img src="{{ url('/storage/website/knitted-baby-suit-benefits-04.svg') }}" class="el-image uk-text-emphasis" alt uk-svg />

                                <h2 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom">Secure Payment</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(strpos($url,'?test') !== false)
<div class="uk-section-muted uk-section">
    <div class="uk-container">
            <div uk-grid class="uk-flex-middle uk-grid-small">
            	<div class="uk-width-1-1">
            		<h2 class="uk-h2 uk-margin-medium uk-text-left">Customer Reviews</h2>
            	</div>
            </div>
            <hr class="bold-line uk-margin" />
            <div uk-grid>
            	<div class="uk-width-1-3@m">
            		<div class="star-rating">
                        <fieldset class="rating uk-padding-remove uk-margin-remove uk-float-left">
                            <input type="radio" disabled id="star5" value="5" @if($avg_review_count==5) checked @endif />
                            <label class="full" for="star5" title="5 stars"></label>

                            <input disabled type="radio" id="star4half" value="4.5" @if($avg_review_count==4.5) checked @endif />
                            <label class="half" for="star4half" title="4.5 stars"></label>

                            <input type="radio" disabled id="star4" value="4" @if($avg_review_count==4) checked @endif />
                            <label class="full" for="star4" title="4 stars"></label>

                            <input type="radio" disabled id="star3half" value="3.5" @if($avg_review_count==3.5) checked @endif />
                            <label class="half" for="star3half" title="3.5 stars"></label>

                            <input type="radio" disabled id="star3" value="3" @if($avg_review_count==3) checked @endif />
                            <label class="full" for="star3" title="3 stars"></label>

                            <input type="radio" disabled id="star2half" value="2.5" @if($avg_review_count==2.5) checked @endif />
                            <label class="half" for="star2half" title="2.5 stars"></label>

                            <input type="radio" disabled id="star2" value="2" @if($avg_review_count==2) checked @endif />
                            <label class="full" for="star2" title="2 stars"></label>

                            <input disabled type="radio" id="star1half" value="1.5" @if($avg_review_count==1.5) checked @endif />
                            <label class="half" for="star1half" title="1.5 stars"></label>

                            <input type="radio" disabled id="star1" value="1" @if($avg_review_count==1) checked @endif />
                            <label class="full" for="star1" title="1 star"></label>

                            <input type="radio" disabled id="starhalf" value="0.5" @if($avg_review_count==0.5) checked @endif />
                            <label class="half" for="starhalf" title="0.5 stars"></label>
                        </fieldset>
                    </div>
                    <div class="uk-clearfix"></div>
            		<div class="uk-panel uk-margin-remove-vertical full">Average Rating : {{$avg_review_count}} Stars</div>
            		<div>{{ $review_count }} Customer Review</div>
            	</div>
	            <div class="uk-width-2-3@m">
	                @if($review_count > 0 && $reviews != null)
	                    @php $i=0; @endphp
	                    @foreach($reviews as $key => $review)
	                    @php $i++; @endphp
	                    <div>
	                        <article class="uk-comment uk-comment-default">
	                            <header class="uk-comment-header">
	                                <div uk-grid class="uk-grid-small">
	                                	<div class="uk-width-1-2">
		                                    <div>
		                                        <h4 class="uk-h4 uk-margin-remove"><a class="uk-link-reset" href="javascript:void(0);">{{ $review['customer']['name'] }}</a>
		                                        </h4>
		                                        <p class="uk-margin-remove uk-text-small uk-text-muted">
		                                            <span>{{ date("M j, Y", strtotime($review['created_at'] )) }}</span>
		                                        </p>
		                                    </div>
	                                    </div>
	                                    <div class="uk-width-1-2">
	                                    	<div class="star-rating">
	                                            <fieldset class="rating uk-padding-remove uk-margin-remove">
	                                                <input type="radio" disabled id="star5" name="rating-{{$i}}" value="5" @if($review['rating_count']==5) checked @endif />
	                                                <label class="full" for="star5" title="5 stars"></label>

	                                                <input disabled type="radio" id="star4half" name="rating-{{$i}}" value="4.5" @if($review['rating_count']==4.5) checked @endif />
	                                                <label class="half" for="star4half" title="4.5 stars"></label>

	                                                <input type="radio" disabled id="star4" name="rating-{{$i}}" value="4" @if($review['rating_count']==4) checked @endif />
	                                                <label class="full" for="star4" title="4 stars"></label>

	                                                <input type="radio" disabled id="star3half" name="rating-{{$i}}" value="3.5" @if($review['rating_count']==3.5) checked @endif />
	                                                <label class="half" for="star3half" title="3.5 stars"></label>

	                                                <input type="radio" disabled id="star3" name="rating-{{$i}}" value="3" @if($review['rating_count']==3) checked @endif />
	                                                <label class="full" for="star3" title="3 stars"></label>

	                                                <input type="radio" disabled id="star2half" name="rating-{{$i}}" value="2.5" @if($review['rating_count']==2.5) checked @endif />
	                                                <label class="half" for="star2half" title="2.5 stars"></label>

	                                                <input type="radio" disabled id="star2" name="rating-{{$i}}" value="2" @if($review['rating_count']==2) checked @endif />
	                                                <label class="full" for="star2" title="2 stars"></label>

	                                                <input disabled type="radio" id="star1half" name="rating-{{$i}}" value="1.5" @if($review['rating_count']==1.5) checked @endif />
	                                                <label class="half" for="star1half" title="1.5 stars"></label>

	                                                <input type="radio" disabled id="star1" name="rating-{{$i}}" value="1" @if($review['rating_count']==1) checked @endif />
	                                                <label class="full" for="star1" title="1 star"></label>

	                                                <input type="radio" disabled id="starhalf" name="rating-{{$i}}" value="0.5" @if($review['rating_count']==0.5) checked @endif />
	                                                <label class="half" for="starhalf" title="0.5 stars"></label>
	                                            </fieldset>
	                                        </div>
	                                    </div>
	                                </div>
	                            </header>
	                            <div class="uk-comment-body">
	                                <p>
	                                    {!! $review['comment'] !!}
	                                </p>
	                            </div>
	                        </article>
	                    </div>
	                    @if($key !== array_key_last($reviews))
	                    <hr class="uk-margin-medium" />
	                    @endif
	                    @endforeach
	                @else
	                <div class="uk-h4 uk-font-secondary uk-text-muted">No reviews at the moment.</div>
	                @endif
	                <!-- <hr class="bold-line uk-margin-medium" />
	                <div class="uk-panel uk-text-muted uk-margin">Please login to your account to review products *</div> -->
	            </div>
            </div>

    </div>
</div>

<div class="uk-section-default uk-section">
    <div class="uk-container">
        <div class="tm-grid-expand uk-grid-margin uk-grid" uk-grid="">
            <div class="uk-width-1-3@m uk-first-column">
                <h2 class="uk-h2 uk-margin-medium uk-text-left">Question & Answer</h2>
            </div>
            <div class="uk-width-2-3@m">

                @if(count($question_answers) > 0 && $question_answers != null)
                    @php $i=0; @endphp
                    @foreach($question_answers as $key => $row)
                    @php $i++; @endphp
                    <div>
                        <article class="uk-comment uk-comment-default">
                            <header class="uk-comment-header">
                                <div>
                                    <div class="">
                                        <h4 class="uk-h4 uk-margin-remove uk-text-emphasis">{{ $row['question'] }}</h4>
                                        <p class="uk-margin-remove uk-text-small uk-text-muted">
                                            <span>{{ $row['customer']['name'] .' - '. date("M j, Y", strtotime($row['created_at'] )) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </header>

                            <div class="uk-comment-body">
                                <div class="uk-margin-remove">{!! $row['answer'] !!}</div>
                                <p class="uk-margin-remove uk-text-small uk-text-muted">
                                    <span>Replied at {{ date("M j, Y", strtotime($row['replied_at'] )) }}</span>
                                </p>
                            </div>
                        </article>
                    </div>
                    @if($key !== array_key_last($question_answers))
                    <hr class="uk-margin-medium" />
                    @endif
                    @endforeach
                @endif
                <hr>
                @if($auth)
                    <div class="uk-margin-medium-top">
                        <form class="uk-form-stacked" method="POST" action="{{ route('product.question.answer.save', $product['uuid']) }}">
                            @csrf
                            <div class="uk-margin">
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="3" placeholder="Add your question" name="question" id="question"></textarea>
                                </div>
                            </div>
                            <div class="uk-margin-small">
                                <button class="uk-button uk-button-default uk-button-large uk-width-1-1" type="submit">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="uk-panel uk-text-muted uk-margin"><a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> to ask questions to seller</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@if($other_products->count() > 0)
<div class="uk-section-primary uk-section">
    <div class="uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-width-1-1@m">
                <h2 class="uk-h2 uk-margin-large uk-text-center">More in Our Shop</h2>
                <div class="uk-text-center">
                    <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-grid-match" uk-grid>
                        @foreach($other_products as $row)
                            @php
                            $default = $row['default_variant'];
                            @endphp
                            <div>
                                <div class="el-item uk-panel uk-margin-remove-first-child">
                                    <a href="{!! $domain.$row['alias'] !!}">
                                        <div class="uk-inline-clip uk-transition-toggle uk-box-shadow-hover-large">
                                            @if($row['image'] != null)
                                                <img
                                                    src="{{ secure_img_product($row['image']['image'], 'main') }}"
                                                    class="el-image uk-transition-scale-up uk-transition-opaque lozad img-400"
                                                    alt
                                                />
                                            @else
                                            <img
                                                src="{{ url('/storage/website/default.jpg') }}"
                                                class="el-image uk-transition-scale-up uk-transition-opaque lozad img-400"
                                                alt
                                                />
                                            @endif
                                        </div>
                                    </a>

                                    <h3 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom"><a href="{!! $domain.$row['alias'] !!}" class="uk-link-heading">{!! $row['name'] !!}</a></h3>
                                    @php $other_pricing = $row['pricing']; @endphp
                                    @if($pricing != null && $pricing->current_offer != null)
                                        <div class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($pricing->current_price/$rate), 2) !!}</div>
                                        <s class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($pricing->original_price/$rate), 2) !!}</s>
                                        @if($pricing->discount_rate > 0)
                                            <span class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">-{{ $pricing->discount_rate }} %</span>
                                        @endif
                                    @else
                                        <div class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($default['selling_price']/$rate), 2) !!}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
    <link type="text/css" href="{{ asset('ecommerce/plugins/magiczoomplus/magiczoomplus.css') }}" rel="stylesheet" media="screen" />
    <link type="text/css" href="{{ asset('ecommerce/plugins/magiczoomplus/magiczoomplus.module.css') }}" rel="stylesheet" media="screen" />
    <link type="text/css" href="{{ asset('ecommerce/plugins/magiczoomplus/magictoolbox.css') }}" rel="stylesheet" media="screen" />
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('ecommerce/plugins/magiczoomplus/magiczoomplus.js') }}"></script>
<script type="text/javascript" src="{{ asset('ecommerce/plugins/magiczoomplus/magictoolbox.utils.js') }}"></script>
<script>
    var has_variant = "{{ $product['has_variant'] }}";
    var product_variations = @if($product['has_variant'] != 0) @json($product['variant']) @else @json($product['default_variant']) @endif;
    var prepare_direct_checkout_url = "{{ route('checkout.direct.prepare') }}";
    var direct_checkout_url = "{{ route('checkout.direct') }}";
    var pricing = @if($pricing != null) @json($pricing) @else null @endif;

    var mzOptions = {
        history: false,
        zoomWidth: "auto",
        zoomHeight: "auto",
        zoomPosition: "right",
        zoomDistance: 15,
        selectorTrigger: "click",
        transitionEffect: true,
        lazyZoom: true,
        rightClick: false,
        cssClass: "",
        zoomMode: "magnifier",
        zoomOn: "hover",
        upscale: true,
        smoothing: true,
        variableZoom: false,
        zoomCaption: "off",
        expand: "window",
        expandZoomMode: "zoom",
        expandZoomOn: "click",
        expandCaption: true,
        closeOnClickOutside: true,
        hint: "once",
        textHoverZoomHint: "Hover to zoom",
        textClickZoomHint: "Click to zoom",
        textExpandHint: "Click to expand",
        textBtnClose: "Close",
        textBtnNext: "Next",
        textBtnPrev: "Previous",
    };
    var mzMobileOptions = {
        zoomMode: "off",
        textHoverZoomHint: "Touch to zoom",
        textClickZoomHint: "Double tap or pinch to zoom",
        textExpandHint: "Tap to expand",
    };

</script>
@endpush
