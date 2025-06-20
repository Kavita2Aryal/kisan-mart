@extends('layout.app')

@section('title')
Cart
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
        @if($carts && count($carts) > 0)
            <div class="tm-grid-expand uk-grid-column-large uk-grid-margin" uk-grid>
                <div class="uk-width-2-3@m">
                    <h3 class="uk-h3">CART ITEMS</h3>
                    <div class="uk-margin">
                        <div class="uk-child-width-1-1 uk-grid-small uk-grid-match product-item-main" uk-grid>
                            @php $total=0; @endphp
                            @foreach($carts as $cart)
                                @isset($cart['gift_voucher_uuid'])
                                    <div>
                                        <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                                            <div class="uk-child-width-expand" uk-grid>
                                                <div class="uk-width-auto@m">
                                                    @if($cart['image'] != null)
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ secure_img_ecom($cart['image'], 'main') }}" width="100px" height="150px" />
                                                    @else
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" width="100px" height="150px" />
                                                    @endif
                                                </div>
                                                <div class="uk-margin-remove-first-child">
                                                    <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                                        <a class="uk-alert-close remove-from-cart" href="javascript:void(0);" data-uuid="{{ $cart['uuid'] }}" uk-close></a>
                                                        {!! $cart['name'] !!}
                                                    </h4>

                                                    <div class="el-content uk-panel uk-margin-small">
                                                        <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">{!! $cart['value'] !!}</span></p>
                                                        <div class="uk-margin-small">
                                                            <div class="qtyselector" id="qtyselector-{{ $cart['id'] }}" data-qty="{{ $cart['qty'] }}" data-price="{{ $cart['price'] }}" data-uuid="{{ $cart['gift_voucher_uuid'] }}">
                                                                <div class="uk-grid-collapse uk-child-width-auto uk-text-center" uk-grid>
                                                                    <div>
                                                                        <a class="minus qty-subtract" data-index="{{ $cart['id'] }}" href="javascript:void(0);">-</a>
                                                                    </div>
                                                                    <div>
                                                                        <div class="qty"><input class="uk-input show-qty" id="show-qty-{{ $cart['id'] }}" type="text" value="{{ $cart['qty'] }}" readonly /></div>
                                                                    </div>
                                                                    <div>
                                                                        <a class="plus qty-add" data-index="{{ $cart['id'] }}" href="javascript:void(0);">+</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="money-show-container-{{ $cart['id'] }}">
                                                        @php $total += $cart['total']/$rate; @endphp
                                                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                            {!! $currency->name .' '. number_format(($cart['total']/$rate), 2) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @php $pricing = $cart['pricing']; @endphp
                                    <div>
                                        <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                                            <div class="uk-child-width-expand" uk-grid>
                                                <div class="uk-width-auto@m">
                                                    @if($cart['image'] != null)
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ secure_img_product($cart['image']->image, 'main') }}" width="100px" height="150px" />
                                                    @else
                                                    <img class="el-image lozad" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" width="100px" height="150px" />
                                                    @endif
                                                </div>
                                                <div class="uk-margin-remove-first-child">
                                                    <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                                        <a class="uk-alert-close remove-from-cart" href="javascript:void(0);" data-uuid="{{ $cart['uuid'] }}" uk-close></a>
                                                        {!! $cart['name'] !!}
                                                    </h4>

                                                    <div class="el-content uk-panel uk-margin-small">
                                                        @if($cart['variation']['size'] != null)
                                                        <p class="uk-margin-remove"> Size: {!! $cart['variation']['size'] !!} </p>
                                                        @endif
                                                        @if($cart['variation']['color'] != null)
                                                        <p class="uk-margin-remove"> Color: {!! $cart['variation']['color'] !!} </p>
                                                        @endif
                                                        <div class="uk-margin-small">
                                                            @php $product_pricing = ($pricing->current_offer != null) ? json_encode ((array) $pricing) : null; @endphp
                                                            <div class="qtyselector" id="qtyselector-{{ $cart['id'] }}" data-qty="{{ $cart['variation']['qty'] }}" data-price="{{ $cart['variation']['selling_price'] }}" data-uuid="{{ $cart['product_uuid'] }}" data-sku="{{ $cart['product_sku'] }}" data-pricing="{{ $product_pricing }}">
                                                                <div class="uk-grid-collapse uk-child-width-auto uk-text-center" uk-grid>
                                                                    <div>
                                                                        <a class="minus qty-subtract" data-index="{{ $cart['id'] }}" href="javascript:void(0);">-</a>
                                                                    </div>
                                                                    <div>
                                                                        <div class="qty"><input class="uk-input show-qty" id="show-qty-{{ $cart['id'] }}" type="text" value="{{ $cart['qty'] }}" readonly /></div>
                                                                    </div>
                                                                    <div>
                                                                        <a class="plus qty-add" data-index="{{ $cart['id'] }}" href="javascript:void(0);">+</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="money-show-container-{{ $cart['id'] }}">
                                                        @if($pricing->current_offer != null)
                                                        @php $total += ($pricing->current_price * $cart['qty'])/$rate; @endphp

                                                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                            {{ $currency->name .' '. number_format(($pricing->current_price * $cart['qty'])/$rate, 2) }}
                                                        </div>
                                                        <s class="uk-text-small uk-text-muted uk-text-normal">{{ $currency->name .' '. number_format(($pricing->original_price * $cart['qty'])/$rate, 2) }}</s>
                                                            @if($pricing->discount_rate > 0)
                                                                <span class="uk-h6 uk-margin-small-top uk-margin-remove-bottom">-{{ $pricing->discount_rate }} %</span>
                                                            @endif
                                                        @else
                                                        @php $total += $cart['variation']['total']/$rate; @endphp
                                                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                            {!! $currency->name .' '. number_format(($cart['variation']['total']/$rate), 2) !!}
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
                    <h3>CART SUMMARY</h3>
                    <hr />
                    <ul class="uk-list" id="page#0-0-1-2">
                        <li class="el-item">
                            <div class="uk-child-width-expand uk-grid-row-small" uk-grid>
                                <div class="uk-width-auto">
                                    <div class="el-title uk-margin-remove uk-text-bold">Subtotal</div>
                                </div>
                                <div>
                                    <div class="el-meta">{!! $currency->name .' '. number_format(($total), 2) !!}</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="uk-margin">
                        <div class="uk-flex-middle uk-grid-small uk-child-width-1-1" uk-grid>
                            <div class="el-item">
                                <a class="el-content uk-width-1-1 uk-button uk-button-secondary" title="Go to checkout" href="{{ route('checkout.index') }}">
                                    Go to checkout
                                </a>
                            </div>

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
                <img src="{{ url('storage/website/cart.svg') }}" style="width:100px;">

                <h3 class="uk-h3">Your Shopping Bag is Empty!</h3>
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