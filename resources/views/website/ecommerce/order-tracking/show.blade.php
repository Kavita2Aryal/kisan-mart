@extends('layout.app')

@section('title')
Order Details
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
$currency = $order->exchangeRate->currency->currency;
$payment_status = get_list_group('payment-status');
@endphp
<div class="uk-section-muted uk-section uk-section-small">
    <div class="uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-text-center">
                <h1>Details of your Order</h1>
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-section uk-section-large uk-padding-remove-bottom">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                <a target="_blank" class="pull-right uk-button uk-button-default uk-button-medium" href="{{ route('order.tracking.export.pdf', [$order->uuid]) }}"><span uk-icon="download"></span> Download PDF</a>
                <h2>Order Placed on: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d M, Y') }}</h2>
            </div>
        </div>
        @php $value = 0; @endphp
        @if($status == "Pending")
        @php $value = 10; @endphp
        @elseif($status == "Confirmed")
        @php $value = 30; @endphp
        @elseif($status == "Shipped")
        @php $value = 60; @endphp
        @elseif($status == "Delivered")
        @php $value = 100; @endphp
        @endif
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                @if($status != "Cancelled")
                <div><progress class="uk-progress" value="{{ $value }}" max="100"></progress></div>
                <div class="uk-margin">
                    <div class="uk-child-width-1-4 uk-grid-match" uk-grid>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">1. Order Placed</h3>
                            </div>
                        </div>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">2. Processing</h3>
                            </div>
                        </div>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">3. Shipped</h3>
                            </div>
                        </div>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">4. Delivered</h3>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="uk-margin">
                    <div class="uk-child-width-1-1 uk-grid-match" uk-grid>
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                <h3 class="el-title uk-h3 uk-margin-top uk-margin-remove-bottom uk-text-danger">Order has been cancelled!</h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-section">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                <hr />
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-section uk-padding-remove-top uk-padding-remove-bottom">
    <div class="uk-container">
        <div class="tm-grid-expand uk-grid-column-medium uk-grid-divider uk-grid-margin" uk-grid>
            <div class="uk-width-1-3@m">
                <h2 class="uk-h3">Your Item</h2>
                <p><span class="uk-h5">Order Code: {{ $order->order_code }}</span></p>
                <div class="uk-margin">
                    <div class="uk-child-width-1-1 uk-grid-column-medium uk-grid-divider uk-grid-match" uk-grid>
                        @if($order->details->count() > 0)
                        @foreach($order->details as $item)
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                <div class="uk-child-width-expand uk-grid-small" uk-grid>
                                    @if($item->product_id != null)
                                        <div class="uk-width-auto">
                                            @if($item->product->thumbnail != null && $item->product->thumbnail->image != null)
                                            <img class="el-image lozad hw-150" alt src="{{ secure_img_product($item->product->thumbnail->image, 'main') }}" uk-img />
                                            @else
                                            <img class="el-image lozad hw-150" alt src="{{ url('storage/website/default.jpg') }}" uk-img />
                                            @endif
                                        </div>
                                        <div class="uk-margin-remove-first-child">
                                            <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                                {!! ucwords($item->product->name) !!}
                                            </h4>
                                            @if($item->variation->size_id != null)
                                            <div class="el-content uk-panel uk-margin-small-top">Size: {!! ucwords($item->variation->variant_size->value) !!}</div>
                                            @endif
                                            @if($item->variation->color_id != null)
                                            <div class="el-content uk-panel uk-margin-small-top">Color: {!! ucwords($item->variation->variant_color->name) !!}</div>
                                            @endif
                                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">Quantity: {!! $item->qty !!}</div>
                                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                {!! $currency .' '. number_format($item->price, 2) !!}
                                            </div>
                                        </div>
                                    @else
                                        <div class="uk-width-auto">
                                            @if($item->gift_voucher->image != null && $item->gift_voucher->image != null)
                                            <img class="el-image lozad hw-150" alt src="{{ secure_img_ecom($item->gift_voucher->image, 'main') }}" uk-img />
                                            @else
                                            <img class="el-image lozad hw-150" alt src="{{ url('storage/website/default.jpg') }}" uk-img />
                                            @endif
                                        </div>
                                        <div class="uk-margin-remove-first-child">
                                            <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">
                                                <span class="badge-read uk-badge uk-font-primary uk-text-small uk-position-top-right uk-margin-small-right uk-margin-small-top" uk-tooltip="Ready to Wear" style="display:none;">R</span>

                                                {!! $item->gift_voucher->title !!}
                                            </h4>
                                            <div class="el-content uk-panel uk-margin-small-top">Code: {!! $item->gift_voucher->code !!}</div>
                                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">Quantity: {!! $item->qty !!}</div>
                                            <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                                                {!! $currency .' '. number_format($item->price, 2) !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @php
            $shipping = $order->shipping;
            $billing = isset($order->billing) ? $order->billing : $shipping;
            $payment_type = get_list_group('payment_type');
            @endphp
            <div class="uk-width-1-3@m">
                @if($billing != null)
                    <h2 class="uk-h3">Billing Address</h2>
                    <ul class="uk-list uk-list-collapse">
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $billing->full_name }}</div>
                        </li>
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $billing->address_line_1 }}</div>
                        </li>
                        @if($billing->country != 0)
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $billing->area != null ? getName('Area', $billing->area) : '' }}, {{ $billing->city != null ? getName('City', $billing->city) : '' }},</div>
                        </li>
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $billing->region != null ? getName('Region', $billing->region) : '' }},</div>
                        </li>
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $billing->country != null ? getName('Country', $billing->country) : 'Nepal' }}</div>
                        </li>
                        @endif
                    </ul>
                @endif
                <h2 class="uk-h3">Contact Information:</h2>
                <ul class="uk-list uk-list-collapse">
                    <li class="el-item">
                        <div class="el-content uk-panel">
                            <a href="mailto:{{ $order->customer->email }}">{{ $order->customer->email }}</a>
                        </div>
                    </li>
                    <li class="el-item">
                        <div class="el-content uk-panel">{{ $order->customer->phone }}</div>
                    </li>
                </ul>
            </div>

            <div class="uk-width-1-3@m">
                @if($shipping != null)
                    <h2 class="uk-h3">Delivery Address</h2>
                    <ul class="uk-list uk-list-collapse">
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $shipping->full_name }}</div>
                        </li>
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $shipping->address_line_1 }}</div>
                        </li>
                        @if($shipping->country != 0)
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $shipping->area != null ? getName('Area', $shipping->area) : '' }}, {{ $shipping->city != null ? getName('City', $shipping->city) : '' }},</div>
                        </li>
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $shipping->region != null ? getName('Region', $shipping->region) : '' }},</div>
                        </li>
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $shipping->country != null ? getName('Country', $shipping->country) : 'Nepal' }}</div>
                        </li>
                        @endif
                        <li class="el-item">
                            <div class="el-content uk-panel">{{ $shipping->delivery_instructions }}</div>
                        </li>
                    </ul>
                @endif
                @if($order->payment_type != null)
                <h2 class="uk-h3">Payment Option</h2>
                <div class="uk-panel uk-margin">{{ $payment_type[$order->payment_type] }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-section">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                <hr />
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-width-1-2">
                <h2 class="uk-h3">Payment Summary</h2>
                <div>
                    <div>
                        <ul class="uk-list">
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="uk-margin-remove uk-text-bold">SUBTOTAL</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right">{{ $currency . ' ' . number_format($order->sub_total, 2) }}</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">SHIPPING</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right">{{ $currency . ' ' .  number_format($order->delivery_charge, 2) }}</div>
                                    </div>
                                </div>
                            </li>
                            @if($order->vat_amount > 0)
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">VAT</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right">{{ $currency . ' ' .  number_format($order->vat_amount, 2) }}</div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @if($order->discount_amount > 0)
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">PROMO DISCOUNT</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right">{{ $currency . ' ' .  number_format($order->discount_amount, 2) }}</div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @if($order->delivery_charge > 0)
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">SHIPPING & HANDLING FEE</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right">{{ $currency . ' ' .  number_format($order->delivery_charge, 2) }}</div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>

                        <hr class="bold-line" />

                        <ul class="uk-list">
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold uk-h4">YOUR TOTAL</div>
                                    </div>
                                    <div>
                                        <div class="uk-h4 uk-margin-remove uk-text-right">{{ $currency . ' ' .  number_format($order->total, 2) }}</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-2"></div>
        </div>
    </div>
</div>
<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-flex uk-flex-center">
                <a class="uk-button uk-button-secondary uk-button-medium uk-margin-right" href="{{ route('home') }}">Continue Shopping</a>
                @if(Auth::user())
                <a class="uk-button uk-button-default uk-button-medium" href="{{ route('dashboard') }}">Go to Profile</a>
                @else
                <a class="uk-button uk-button-default uk-button-medium" href="{{ route('login') }}">Login</a>
                @endif
            </div>
        </div>
    </div>
</div>
@if($settings['help-status'] == "ON")
<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container uk-card uk-card-default">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-margin-top">
                <div class="el-item uk-panel uk-margin-remove-first-child">
                    <h3 class="el-title uk-h2 uk-margin-top uk-margin-remove-bottom">{!! $settings['help-title'] !!}</h3>
                    <div class="el-meta uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $settings['help-description'] !!}</div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="el-item uk-panel uk-margin-remove-first-child">
                    <div class="uk-child-width-expand uk-grid-column-medium uk-grid" uk-grid="">
                        <div class="uk-width-auto uk-first-column"><span class="el-image uk-icon" uk-icon="icon: whatsapp; width: 32; height: 32;"></span></div>
                        <div class="uk-margin-remove-first-child">
                            <div class="el-content uk-panel uk-margin-top">
                                <div>
                                    Call or WhatsApp us<br>
                                    <span class="uk-h4"> {!! $settings['contact-mobile'] !!} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="el-item uk-panel uk-margin-remove-first-child">
                    <div class="uk-child-width-expand uk-grid-column-medium uk-grid" uk-grid="">
                        <div class="uk-width-auto uk-first-column"><span class="el-image uk-icon" uk-icon="icon: mail; width: 32; height: 32;"></span></div>
                        <div class="uk-margin-remove-first-child">
                            <div class="el-content uk-panel uk-margin-top">
                                <div>
                                    Email Us<br>
                                    <a class="el-content" href="mailto:{!! $settings['contact-email'] !!}">
                                        {!! $settings['contact-email'] !!}
                                    </a>
                                </div>
                            </div>
                        </div>
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
@endpush

@push('scripts')

@endpush