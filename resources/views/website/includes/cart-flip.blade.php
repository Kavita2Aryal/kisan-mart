@php
$currency = get_currency();
$rate = $currency->rate;
@endphp
<div class="uk-child-width-1-1 uk-grid-small uk-grid-match uk-grid uk-grid-stack" uk-grid="">
    @php $total = 0; $delivery = 0; $grandtotal = 0; @endphp
    @foreach($carts as $cart)
    <div class="uk-first-column product-item-list" id="product-item-list-{{ $cart['id'] }}">
        <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
            <div class="uk-child-width-expand uk-grid uk-grid-small" uk-grid="">
                @isset($cart['gift_voucher_uuid'])
                    <div class="uk-width-auto uk-first-column">
                        <a href="{{ $domain.$cart['alias'] }}">
                            @if($cart['image'] != null)
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ secure_img_ecom($cart['image'], 'main') }}" />
                            @else
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" />
                            @endif
                        </a>
                    </div>

                    <div class="uk-margin-remove-first-child">
                        <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove">
                            <a href="javascript:void(0);" class="uk-icon-link uk-text-muted remove-from-cart uk-position-top-right uk-margin-small-right uk-margin-small-top" data-uuid="{{ $cart['uuid'] }}">
                                <span class="uk-icon" uk-icon="close"></span>
                            </a>
                            <a class="uk-link-reset" href="{{ $domain.$cart['alias'] }}">{!! $cart['title'] !!}</a>

                        </h4>
                        <input type="hidden" id="product-total-{{ $cart['id'] }}" value="{{ $cart['total'] }}">
                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                            <div class="uk-margin-small-bottom"><span class="uk-text-muted uk-text-small">{!! $cart['value'] !!}</span></div>
                            <div class="uk-margin-small-top uk-margin-small-bottom">
                                <div class="qtyselector" id="qtyselector-{{ $cart['id'] }}" data-price="{{ $cart['price'] }}" data-uuid="{{ $cart['gift_voucher_uuid'] }}">
                                    <div class="uk-grid-collapse uk-child-width-auto uk-text-center" uk-grid>
                                        <div>
                                            <a class="minus qty-subtract-gift-cart" data-index="{{ $cart['id'] }}" href="javascript:void(0);">-</a>
                                        </div>
                                        <div>
                                            <div class="qty"><input class="uk-input show-qty" id="show-qty-{{ $cart['id'] }}" type="text" value="{{ $cart['qty'] }}" readonly /></div>
                                        </div>
                                        <div>
                                            <a class="plus qty-add-gift-cart" data-index="{{ $cart['id'] }}" href="javascript:void(0);">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="money-show-container-{{ $cart['id'] }}">
                                @php $total += $cart['total']; @endphp
                                <span>
                                    {!! $currency->name .' '. number_format(($cart['total']/$rate), 2) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="uk-width-auto uk-first-column">
                        <a href="{{ $domain.$cart['alias'] }}">
                            @if($cart['image'] != null)
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ secure_img_product($cart['image']->image, 'main') }}" />
                            @else
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" />
                            @endif
                        </a>
                    </div>

                    <div class="uk-margin-remove-first-child">
                        <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove">
                            <a href="javascript:void(0);" class="uk-icon-link uk-text-muted remove-from-cart uk-position-top-right uk-margin-small-right uk-margin-small-top" data-uuid="{{ $cart['uuid'] }}">
                                <span class="uk-icon" uk-icon="close"></span>
                            </a>
                            <a class="uk-link-reset" href="{{ $domain.$cart['alias'] }}">{!! $cart['name'] !!}</a>

                        </h4>
                        <input type="hidden" id="product-total-{{ $cart['id'] }}" value="{{ $cart['variation']['total'] }}">
                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                            @if($cart['variation']['size'] != null)
                            Size: {!! $cart['variation']['size'] !!}
                            @endif
                            @if($cart['variation']['color'] != null)
                            Color: {!! $cart['variation']['color'] !!}
                            @endif
                            <div class="uk-margin-small uk-margin-small-top uk-margin-small-bottom">
                                <div class="qtyselector" id="qtyselector-{{ $cart['id'] }}" data-qty="{{ $cart['variation']['qty'] }}" data-price="{{ $cart['variation']['selling_price'] }}" data-uuid="{{ $cart['product_uuid'] }}" data-sku="{{ $cart['product_sku'] }}">
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
                            <div id="money-show-container-{{ $cart['id'] }}">
                                @php $pricing = $cart['pricing']; @endphp
                                @if($pricing->current_offer != null)
                                @php $total += ($pricing->current_price * $cart['qty'])/$rate; @endphp
                                <span>{{ $currency->name .' '. number_format(($pricing->current_price * $cart['qty'])/$rate, 2) }}</span><br>
                                <s class="uk-text-small uk-text-muted uk-margin-small-left uk-text-normal">{{ $currency->name .' '. number_format(($pricing->original_price * $cart['qty'])/$rate, 2) }}</s>
                                <span class="uk-text-italic uk-text-light uk-text-discount">-{{ $pricing->discount_rate }} %</span>
                                @else
                                @php $total += $cart['variation']['total']; @endphp
                                <span>
                                    {!! $currency->name .' '. number_format(($cart['variation']['total']/$rate), 2) !!}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
    @endforeach
    <input type="hidden" class="cart-sub-total" value="{{ $total/$rate }}">
</div>

<hr class="bold-line" />

<div class="order-summary-slide-cart">
    <div>
        <ul class="uk-list">
            <li>
                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                    <div class="uk-width-auto uk-first-column">
                        <div class="uk-margin-remove uk-text-bold">Subtotal</div>
                    </div>
                    <div>
                        <div class="uk-text-right cart-sub-total-display">{{ $currency->name .' '. number_format(($total/$rate), 2) }}</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="uk-text-center uk-margin-large">
    <p>
        <a class="uk-button uk-button-secondary uk-width-1-1" href="{{ route('checkout.index') }}"> Checkout </a>
    </p>
    <p>
        <a class="uk-button uk-button-default uk-width-1-1" href="{{ route('cart.index') }}"> Go to Cart Page </a>
    </p>
</div>
