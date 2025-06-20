@php
$has_discount = false;
$data = Session::get('direct-checkout');
$rate = $currency->rate;
@endphp
@if($product != null)
    <input type="hidden" name="checkout[0][product]" class="product" value="{{ $data['product_uuid'] }}">
    <input type="hidden" name="checkout[0][sku]" class="sku" value="{{ $data['product_sku'] }}">
    <input type="hidden" name="checkout[0][variant]" class="variant" value="{{ $variant[0]['variant'] }}">
    <input type="hidden" name="checkout[0][price]" class="price" value="{{ ($pricing['current_offer'] != null) ? $pricing['current_price'] : $variant[0]['selling_price']/$rate }}">
    <input type="hidden" name="checkout[0][actual_price]" class="price" value="{{ $variant[0]['selling_price']/$rate }}">
    <input type="hidden" name="checkout[0][qty]" class="qty" value="{{ $data['qty'] }}">
    <div class="uk-margin">
        <div class="uk-child-width-1-1 uk-grid-small uk-grid-match" uk-grid>
            <div>
                <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                    <div class="uk-child-width-expand" uk-grid>
                        <div class="uk-width-auto@m">
                            <a href="{{ $domain.$product->alias->alias }}">
                                @if($product->thumbnail != null && $product->thumbnail->image != null)
                                <img class="el-image lozad hw-90" alt src="{{ secure_img_product($product->thumbnail->image, 'main') }}" uk-img />
                                @else
                                <img class="el-image lozad hw-90" alt src="{{ url('/storage/website/default.jpg') }}" uk-img />
                                @endif
                            </a>
                        </div>

                        <div class="uk-margin-remove-first-child">
                            <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                <a class="uk-link-reset" href="{{ $product->alias->alias }}">
                                    {!! $product->name !!}
                                </a>
                            </h4>
                            <div class="el-content uk-panel">
                                @if($variant[0]['size'] != null)
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Size: {!! $variant[0]['size'] !!}</span></p>
                                @endif
                                @if($variant[0]['color'] != null)
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Color: {!! $variant[0]['color'] !!}</span></p>
                                @endif
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Quantity: {!! $data['qty'] !!}</span></p>
                            </div>
                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                @if($pricing['current_offer'] != null)
                                {{ $currency->name .' '. number_format(($pricing['current_price'] * $data['qty'])/$rate, 2) }}<br>
                                <s class="uk-text-small uk-text-muted uk-margin-small-left uk-text-normal">{{ $currency->name .' '. number_format(($pricing['original_price'] * $data['qty'])/$rate, 2) }}</s>
                                    @if($pricing['discount_rate'] > 0)
                                        <span class="uk-text-italic uk-text-light uk-text-discount">-{{ $pricing['discount_rate'] }} %</span>
                                    @endif
                                @else
                                {!! $currency->name .' '. number_format(($selling_price/$rate), 2) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <input type="hidden" name="checkout[0][gift_voucher]" class="gift_voucher" value="{{ $data['gift_voucher_uuid'] }}">
    <input type="hidden" name="checkout[0][price]" class="price" value="{{ $data['price']/$rate }}">
    <input type="hidden" name="checkout[0][qty]" class="qty" value="{{ $data['qty'] }}">

    <div class="uk-margin">
        <div class="uk-child-width-1-1 uk-grid-small uk-grid-match" uk-grid>
            <div>
                <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                    <div class="uk-child-width-expand" uk-grid>
                        <div class="uk-width-auto@m">
                            <a href="{{ $domain.$gift_voucher->alias->alias }}">
                                @if($gift_voucher->image != null)
                                <img class="el-image lozad hw-90" alt src="{{ secure_img_product($gift_voucher->image, 'main') }}" uk-img />
                                @else
                                <img class="el-image lozad hw-90" alt src="{{ url('/storage/website/default.jpg') }}" uk-img />
                                @endif
                            </a>
                        </div>

                        <div class="uk-margin-remove-first-child">
                            <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                <a class="uk-link-reset" href="{{ $gift_voucher->alias->alias }}">
                                    {!! $gift_voucher->name !!}
                                </a>
                            </h4>
                            <div class="el-content uk-panel">
                                <p class="uk-margin-remove"><span class="uk-text-bold">Quantity: {!! $data['qty'] !!}</span></p>
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">{!! $gift_voucher->code !!}</span></p>
                                <p class="uk-margin-remove"><span class="uk-text-muted uk-text-small">Value: {!! $currency->name .' '. number_format(($gift_voucher->value/$rate), 2) !!}</span></p>
                            </div>
                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                {!! $currency->name .' '. number_format(($price/$rate), 2) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
