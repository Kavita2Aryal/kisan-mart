@extends('layout.app')

@section('title')
{!! $gift_voucher['title'] !!}
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
$currency = get_currency();
$rate = $currency->rate;
@endphp

<div class="uk-section-default uk-section uk-padding-remove-top product-item-main">
    <input type="hidden" class="gift-voucher" value="{{ $gift_voucher['uuid'] }}">
    <input type="hidden" class="qty" value="1">
    <input type="hidden" class="price" value="{{ $gift_voucher['price'] }}">

    <div class="uk-margin-medium uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-grid-column-collapse uk-grid-row-large" uk-grid>
            <div class="uk-width-1-2@m">
                <div uk-slideshow="ratio: 1:1; minHeight: 500; animation: fade;" class="uk-margin-remove-vertical">
                    <div class="uk-position-relative">
                        <ul class="uk-slideshow-items">
                            @if($gift_voucher['image'] != null)
                                @php $img = secure_img_ecom($gift_voucher['image'], 'main'); @endphp
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
                        </ul>
                    </div>
                </div>
            </div>
            <div class="uk-grid-item-match uk-width-1-2@m">
                <div class="uk-tile-default uk-tile uk-flex uk-flex-middle">
                    <div class="uk-panel uk-width-1-1">
                        <div class="uk-h6 uk-text-muted uk-margin-remove-vertical uk-width-xlarge uk-margin-auto@m uk-text-left">Gift Voucher</div>
                        <h1 class="uk-h2 uk-margin uk-width-xlarge uk-margin-auto@m uk-text-left">{!! $gift_voucher['title'] !!}</h1>
                        <div class="uk-h3 uk-margin-remove-vertical uk-width-xlarge uk-margin-auto@m uk-text-left money-show-container">
                            {!! $currency->name . ' ' . number_format(($gift_voucher['price']/$rate),2) !!}
                        </div>
                        <div class="uk-margin-medium uk-width-xlarge@m uk-margin-auto">
                            {!! $gift_voucher['description'] !!}
                        </div>
                        <div class="uk-margin uk-width-xlarge@m uk-margin-auto">
                            <div class="quantity-container">
                                <p class="uk-margin-small uk-text-meta">QUANTITY</p>
                                <div class="uk-margin-small">
                                    <div class="qtyselector">
                                        <div class="uk-grid-collapse uk-child-width-auto uk-text-center" uk-grid>
                                            <div>
                                                <a class="minus qty-subtract-gift-voucher" href="javascript:void(0);">-</a>
                                            </div>
                                            <div>
                                                <div class="qty"><input class="uk-input show-qty" type="text" value="1" readonly /></div>
                                            </div>
                                            <div>
                                                <a class="plus qty-add-gift-voucher" href="javascript:void(0);">+</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="uk-grid-small uk-width-xlarge uk-margin-auto paddingremove" uk-grid>
                            <div class="uk-width-1-2@s">
                                <div class="uk-margin uk-width-xlarge@m uk-margin-auto parent-wishlist-button">
                                    <a href="javascript:void(0);" class="el-content uk-button uk-width-1-1 uk-button-default @if(Auth::user()) add-to-wishlist @endif" @if(!Auth::user()) uk-toggle="target: #wishlist-modal" @endif style="{{ ($wishlist_gift_vouchers != null && array_key_exists($gift_voucher['uuid'], $wishlist_gift_vouchers)) ? 'display:none' : '' }}">
                                        <span uk-icon="heart" class="uk-icon"></span>
                                        <span class="uk-text-middle uk-margin-small-left">ADD TO WISHLIST</span>
                                    </a>
                                    <a href="javascript:void(0);" class="el-content uk-button uk-width-1-1 uk-button-default remove-from-wishlist" data-uuid="{{ ($wishlist_gift_vouchers != null && isset($wishlist_gift_vouchers[$gift_voucher['uuid']])) ? $wishlist_gift_vouchers[$gift_voucher['uuid']] : '' }}" style="{{ (($wishlist_gift_vouchers == null) || ($wishlist_gift_vouchers != null && !array_key_exists($gift_voucher['uuid'], $wishlist_gift_vouchers))) ? 'display:none' : '' }}">
                                        <span uk-icon="heart" class="uk-icon"></span>
                                        <span class="uk-text-middle uk-margin-small-left">REMOVE FROM WISHLIST</span>
                                    </a>
                                </div>
                            </div>
                            <div class="uk-width-1-2@s">
                                <div class="uk-margin uk-width-xlarge@m uk-margin-auto cart-functional-buttons add-button">
                                    <a class="el-content uk-width-1-1 uk-button uk-button-secondary @if(Auth::user()) add-to-cart @endif" href="javascript:void(0);" @if(!Auth::user()) uk-toggle="target: #cart-modal" @endif>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin uk-width-xlarge@m uk-margin-auto cart-functional-buttons buy-button">
                            <a class="el-content uk-width-1-1 uk-button uk-button-danger @if(Auth::user()) direct-checkout @endif" href="javascript:void(0);" @if(!Auth::user()) uk-toggle="target: #checkout-modal" @endif data-now="1" data-product-uuid="{{ $gift_voucher['uuid'] }}">
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
            <h3 class="uk-text-center uk-h3">You need to be logged in to add this gift voucher in your wishlist</h3>

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
            <h3 class="uk-text-center uk-h3">You need to be logged in to add this gift voucher in your cart</h3>

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
            <h3 class="uk-text-center uk-h3">You need to be logged in to buy the gift voucher</h3>

            <a href="{{ route('login') }}" class="uk-button uk-button-default uk-margin-small-top" aria-="" rel="nofollow">LOGIN</a>
            <a href="javascript:void(0)" class="uk-button uk-button-primary uk-modal-close uk-margin-small-top">Cancel</a>
        </div>
    </div>
</div>
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

@if($others->count() > 0)
<div class="uk-section-primary uk-section">
    <div class="uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-width-1-1@m">
                <h2 class="uk-h2 uk-margin-large uk-text-center">More in Our Shop</h2>
                <div class="uk-text-center">
                    <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-grid-match" uk-grid>
                        @foreach($others as $row)
                            <div>
                                <div class="el-item uk-panel uk-margin-remove-first-child">
                                    <a href="{!! $domain.$row['alias'] !!}">
                                        <div class="uk-inline-clip uk-transition-toggle uk-box-shadow-hover-large">
                                            @if($row['image'] != null)
                                                <img
                                                    src="{{ secure_img_ecom($row['image'], 'main') }}"
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

                                    <h3 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom"><a href="{!! $domain.$row['alias'] !!}" class="uk-link-heading">{!! $row['title'] !!}</a></h3>
                                    <div class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($row['price']/$rate), 2) !!}</div>
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
    var prepare_direct_checkout_url = "{{ route('checkout.direct.prepare') }}";
    var direct_checkout_url = "{{ route('checkout.direct') }}";

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