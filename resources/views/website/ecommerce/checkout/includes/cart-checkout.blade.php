@php $i=0; $j=0; $has_discount = false; $rate = $currency->rate; @endphp
<div class="uk-margin">
    <div class="uk-child-width-1-1 uk-grid-small uk-grid-match" uk-grid>
        @if($carts && count($carts) > 0)
        @foreach($carts as $cart)
        @php $i++; @endphp
        @if(isset($cart['product_uuid']))
            @php $pricing = $cart['pricing']; $j++; @endphp

            <input type="hidden" name="checkout[{{ $i }}][product]" class="product" value="{{ $cart['product_uuid'] }}">
            <input type="hidden" name="checkout[{{ $i }}][sku]" class="sku" value="{{ $cart['product_sku'] }}">
            <input type="hidden" name="checkout[{{ $i }}][variant]" class="variant" value="{{ $cart['variation']['variant'] }}">
            <input type="hidden" name="checkout[{{ $i }}][price]" class="price" value="{{ ($pricing->current_offer != null) ? $pricing->current_price : $cart['variation']['selling_price']/$rate }}">
            <input type="hidden" name="checkout[{{ $i }}][actual_price]" class="price" value="{{ $cart['variation']['selling_price']/$rate }}">
            <input type="hidden" name="checkout[{{ $i }}][qty]" class="qty" value="{{ $cart['qty'] }}">
            <div>
                <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                    <div class="uk-child-width-expand" uk-grid>
                        <div class="uk-width-auto@m">
                            <a href="{{ $domain.$cart['alias'] }}">
                                @if($cart['image'] != null)
                                <img class="el-image lozad hw-90" alt src="{{ secure_img_product($cart['image']->image, 'main') }}" uk-img />
                                @else
                                <img class="el-image lozad hw-90" alt src="{{ url('/storage/website/default.jpg') }}" uk-img />
                                @endif
                            </a>
                        </div>

                        <div class="uk-margin-remove-first-child">
                            <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                <a class="uk-link-reset" href="{{ $cart['alias'] }}">
                                    {!! $cart['name'] !!}
                                </a>
                            </h4>

                            <div class="el-content uk-panel">
                                @if($cart['variation']['size'] != null)
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Size: {!! $cart['variation']['size'] !!}</span></p>
                                @endif
                                @if($cart['variation']['color'] != null)
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Color: {!! $cart['variation']['color'] !!}</span></p>
                                @endif
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Quantity: {!! $cart['qty'] !!}</span></p>
                            </div>
                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                @if($pricing->current_offer != null)
                                {{ $currency->name .' '. number_format(($pricing->current_price * $cart['qty'])/$rate, 2) }}<br>
                                <s class="uk-text-small uk-text-muted uk-margin-small-left uk-text-normal">{{ $currency->name .' '. number_format(($pricing->original_price * $cart['qty'])/$rate, 2) }}</s>
                                    @if($pricing->discount_rate > 0)    
                                        <span class="uk-text-italic uk-text-light uk-text-discount">-{{ $pricing->discount_rate }} %</span>
                                    @endif
                                @else
                                {!! $currency->name .' '. number_format(($cart['variation']['total']/$rate), 2) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <input type="hidden" name="checkout[{{ $i }}][gift_voucher]" class="product" value="{{ $cart['gift_voucher_uuid'] }}">
            <input type="hidden" name="checkout[{{ $i }}][qty]" class="qty" value="{{ $cart['qty'] }}">
            <div>
                <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                    <div class="uk-child-width-expand" uk-grid>
                        <div class="uk-width-auto@m">
                            <a href="{{ $domain.$cart['alias'] }}">
                                @if($cart['image'] != null)
                                <img class="el-image lozad hw-90" alt src="{{ secure_img_ecom($cart['image'], 'main') }}" uk-img />
                                @else
                                <img class="el-image lozad hw-90" alt src="{{ url('/storage/website/default.jpg') }}" uk-img />
                                @endif
                            </a>
                        </div>

                        <div class="uk-margin-remove-first-child">
                            <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                <a class="uk-link-reset" href="{{ $cart['alias'] }}">
                                    {!! $cart['title'] !!}
                                </a>
                            </h4>

                            <div class="el-content uk-panel">
                                <p class="uk-margin-remove"><span class="uk-text-bold">Quantity: {!! $cart['qty'] !!}</span></p>
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">{!! $cart['code'] !!}</span></p>
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Value: {!! $currency->name .' '. number_format(($cart['value']/$rate), 2) !!}</span></p>
                            </div>
                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                {!! $currency->name .' '. number_format(($cart['total']/$rate), 2) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
        @endif
    </div>
</div>