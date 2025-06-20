@extends('layout.app')

@section('title')
    Order Payment
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
    @php
        $items = $data['items'];
        $vat = $data['vat'];
        $currency = $data['currency'];
        $go_back_to_checkout = Session::has('direct-checkout') ? route('checkout.direct') : route('checkout.index');
    @endphp

    <div id="page#0" class="uk-section-default uk-position-relative" tm-header-transparent="dark">
        <div class="uk-background-norepeat uk-background-cover uk-background-center-center uk-section uk-flex uk-flex-middle" uk-height-viewport="offset-top: true;">
            <div class="uk-position-cover" style="background-color: rgba(255, 255, 255, 0.79);"></div>

            <div class="uk-width-1-1">
                <div class="uk-container uk-position-relative">
                    <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
                    <div class="uk-grid-margin uk-container uk-container-xsmall">
                        <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                            <div class="uk-grid-item-match">
                                <div class="uk-tile-default uk-tile uk-tile-small">
                                    <div class="uk-margin uk-text-center">
                                        <a href="{{ route('home') }}"><img width="200" class="el-image" alt data-src="{{ url('storage/website/logo.svg') }}" uk-img /></a>
                                    </div>

                                    <h2 class="uk-h4 uk-text-center uk-text-large uk-margin-small-bottom">Make your payment</h2>
                                    <div class="uk-text-center uk-margin-remove-top uk-margin-medium-bottom">Hi, {{ $data['customer_name'] }}. Please make your payment by choosing one of the available options.</div>

                                    <div class="uk-margin">
                                        <table class="uk-table uk-table-middle uk-table-responsive" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <thead>
                                            <tr>
                                                <!-- <td class="uk-h5">SKU/Code</td> -->
                                                <td class="uk-h5">Product/Gift Voucher</td>
                                                <td class="uk-h5">Quantity</td>
                                                <td class="uk-h5">Price</td>
                                                <td class="uk-h5">Total</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i = 0; @endphp
                                            @foreach($items as $item)
                                                @php $i++; @endphp
                                                @isset($item['product_uuid'])
                                                    <tr>
                                                    <!-- <td>{!! $item['product_sku'] !!}</td> -->
                                                        <td>{!! ucwords($item['product_name']) !!} @if($item['variant'] != null)<br><strong>({{ $item['variant'] }})</strong>@endif</td>
                                                        <td>{!! $item['qty'] !!}</td>
                                                        <td>{!! $currency .' '. number_format(($item['price']), 2) !!}</td>
                                                        <td>{!! $currency .' '. number_format(($item['price'] * $item['qty']), 2) !!}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                    <!-- <td>{!! $item['gift_voucher_code'] !!}</td> -->
                                                        <td>{!! ucwords($item['gift_voucher_title']) !!}<br><strong>({!! $item['gift_voucher_code'] !!})</strong></td>
                                                        <td>{!! $item['qty'] !!}</td>
                                                        <td>{!! $currency .' '. number_format(($item['price']), 2) !!}</td>
                                                        <td>{!! $currency .' '. number_format(($item['price'] * $item['qty']), 2) !!}</td>
                                                    </tr>
                                                @endisset
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr />
                                    <div class="uk-margin">
                                        <ul class="uk-list">
                                            <li>
                                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                                    <div class="uk-width-auto uk-first-column">
                                                        <div class="uk-margin-remove uk-h5">Subtotal</div>
                                                    </div>
                                                    <div>
                                                        <div class="uk-text-right">{{ $currency . ' ' .number_format($data['subtotal'], 2) }}</div>
                                                    </div>
                                                </div>
                                            </li>
                                            @if($data['discount_amount'] > 0)
                                                <li>
                                                    <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                                        <div class="uk-width-auto uk-first-column">
                                                            <div class="uk-margin-remove uk-h5">Discount</div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-text-right">{{ $currency . ' ' .number_format($data['discount_amount'], 2) }}</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            @if($vat['amount']==0 && $vat['rate']!=null)
                                                <li>
                                                    <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                                        <div class="uk-width-auto uk-first-column">
                                                            <div class="uk-margin-remove uk-h5">VAT({{$vat['rate']}}%)</div>
                                                        </div>
                                                        <div>
                                                            <div class="uk-text-right">{{ $currency . ' ' .number_format(($vat['amount']), 2) }}</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            <li>
                                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                                    <div class="uk-width-auto uk-first-column">
                                                        <div class="uk-margin-remove uk-h5">Shipping & Handling Fee</div>
                                                    </div>
                                                    <div>
                                                        <div class="uk-text-right">{{ $currency . ' ' .number_format($data['delivery_charge'], 2) }}</div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <hr class="bold-line" />

                                        <ul class="uk-list">
                                            <li>
                                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                                    <div class="uk-width-auto uk-first-column">
                                                        <div class="el-title uk-margin-remove uk-h5">Total</div>
                                                    </div>
                                                    <div>
                                                        <div class="uk-h4 uk-margin-remove uk-text-right">{{ $currency .' '. number_format($data['total'], 2) }}</div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <h2 class="uk-h5 uk-text-muted uk-margin-remove-top">Choose an option to pay for your order</h2>
                                    <div class="uk-panel uk-margin-remove-first-child uk-margin">
                                        <div class="el-content uk-panel uk-margin-top">
                                            <form class="payment-option-form" action="{{ route('checkout.submit') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="uuid" value="{{ $uuid }}">
                                                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid uk-flex-middle">
                                                    @php $ix = 0; @endphp
                                                    @forelse ($payment_options_check as $key => $pay_opt)
                                                        @if(in_array($payment_options[$pay_opt], $payment_options_status))
                                                            @php $ix++; @endphp
                                                            @isset($config_payment_options[$key])
                                                                <label><input class="uk-radio" type="radio" id="option-{{ $config_payment_options[$key]['code'] }}" name="payment_option" @if($ix == 1) checked @endif value="{{ $key }}"> <img src="{{ $config_payment_options[$key]['logo'] }}" alt=""></label>
                                                            @else
                                                                <label><input class="uk-radio" type="radio" id="option-{{ $key }}" name="payment_option" value="{{ $key }}" @if($ix == 1) checked @endif> {{ $payment_options[$pay_opt] }} </label>
                                                            @endisset
                                                        @endif
                                                    @empty
                                                        <label>No payment option available</label>
                                                    @endforelse

                                                </div>
                                                <div class="uk-margin">
                                                    <button class="uk-button uk-button-secondary uk-button-large uk-width-1-1 uk-margin-top submit-btn-title" type="submit">Make a Payment</button>
                                                </div>
                                            </form>
                                        </div>
                                        <a href="{{ $go_back_to_checkout }}" class="uk-h5"> <span uk-icon="icon: arrow-left"></span> Go Back to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-section-default uk-section uk-padding-remove-vertical">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                <hr id="page#2-0-0-0" />
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $('input[type=radio]').on('change', function() {
            var value = $(this).val();
            var route = '';
            if(value == 'cash-on-delivery' || value == 'card-on-delivery'){
                var text = 'Place an Order';
            }else{
                var text = 'Make a Payment';
            }
            $('.submit-btn-title').html(text);
        })
    </script>
@endpush
