@extends('layout.app')

@section('title')
Wishlist
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
<div class="uk-section-default uk-section">
    <div class="uk-container">
        @if($wishlists && count($wishlists) > 0)
            <div class="tm-grid-expand uk-grid-column-large uk-grid-margin" uk-grid>
                <div class="uk-width-2-3@m">
                    <h3 class="uk-h3">WISHLIST ITEMS</h3>
                    <div class="uk-margin">
                        <div class="uk-child-width-1-1 uk-grid-small uk-grid-match product-item-main" uk-grid>
                            @php $total=0; @endphp
                            @foreach($wishlists as $wishlist)
                                @isset($wishlist['gift_voucher_uuid'])
                                    <div>
                                        <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                                            <div class="uk-child-width-expand" uk-grid>
                                                <div class="uk-width-auto@m">
                                                    @if($wishlist['image'] != null)
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ secure_img_ecom($wishlist['image'], 'main') }}" width="100px" height="150px" />
                                                    @else
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" width="100px" height="150px" />
                                                    @endif
                                                </div>
                                                <div class="uk-margin-remove-first-child">
                                                    <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                                        <a class="uk-alert-close remove-from-wishlist" href="javascript:void(0);" data-uuid="{{ $wishlist['uuid'] }}" uk-close></a>
                                                        {!! $wishlist['name'] !!}
                                                    </h4>
                                                    <div class="el-content uk-panel">
                                                        <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">{!! $wishlist['value'] !!}</span></p>
                                                    </div>
                                                    <div id="money-show-container-{{ $wishlist['id'] }}">
                                                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                            {!! $currency->name .' '. number_format(($wishlist['price']/$rate), 2) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @php $pricing = $wishlist['pricing']; @endphp
                                    <div>
                                        <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                                            <div class="uk-child-width-expand" uk-grid>
                                                <div class="uk-width-auto@m">
                                                    @if($wishlist['image'] != null)
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ secure_img_product($wishlist['image']->image, 'main') }}" width="100px" height="150px" />
                                                    @else
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" width="100px" height="150px" />
                                                    @endif
                                                </div>
                                                <div class="uk-margin-remove-first-child">
                                                    <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                                        <a class="uk-alert-close remove-from-wishlist" href="javascript:void(0);" data-uuid="{{ $wishlist['uuid'] }}" uk-close></a>
                                                        {!! $wishlist['name'] !!}
                                                    </h4>
                                                    <div class="el-content uk-panel">
                                                    </div>
                                                    <div id="money-show-container-{{ $wishlist['id'] }}">
                                                        @if($pricing->current_offer != null)
                                                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                            {!! $currency->name .' '. number_format(($wishlist['price']/$rate), 2) !!}
                                                        </div>
                                                        <s class="uk-text-small uk-text-muted uk-text-normal">{{ $currency->name .' '. number_format($pricing->original_price/$rate, 2) }}</s>
                                                            @if($pricing->discount_rate > 0)
                                                                <span class="uk-h6 uk-margin-small-top uk-margin-remove-bottom">-{{ $pricing->discount_rate }} %</span>
                                                            @endif
                                                        @else
                                                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                        {!! $currency->name .' '. number_format(($wishlist['selling_price']/$rate), 2) !!}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-3@m">
                    <div class="uk-margin">
                        <div class="uk-flex-middle uk-grid-small uk-child-width-1-1" uk-grid>
                            <div class="el-item">
                                <a class="el-content uk-width-1-1 uk-button uk-button-default" title="Go to checkout" href="{{ route('home') }}">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <div class="tm-grid-expand uk-grid-column-large uk-grid-margin" uk-grid>
            <div class="uk-text-center">
                <img src="{{ url('storage/website/wishlist.svg') }}" style="width:100px;">

                <h3 class="uk-h3">Your Wishlist is Empty!</h3>
                <p>Don't hesitate and browse our catalog to find something beautiful for You!</p>
                <a class="uk-button uk-button-default uk-width-1-4" href="{{ route('home') }}"> Browse
                    Our Catalog</a>
            </div>
        </div>
        @endif
    </div>
</div>

@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')

@endpush