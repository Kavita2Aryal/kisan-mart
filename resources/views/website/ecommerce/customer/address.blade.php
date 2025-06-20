@extends('layout.app')
@section('title')
Customer Address Details
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
'title' => 'Address Details',
]
)

<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container">
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div>
                    <h3 class="uk-h4">The following address will be used on the checkout page by default.</h3>
                </div>
            </div>
        </div>
        <div class="uk-grid-margin uk-container">
            <div class="tm-grid-expand" uk-grid>
                <div class="uk-width-1-2@m">
                    <div class="uk-card uk-card-default uk-card-body uk-margin-remove-first-child uk-margin">
                        <h3 class="el-title uk-card-title uk-margin-top uk-margin-remove-bottom">Billing Address</h3>
                        @if($billing_address != null)
                        <div class="el-content uk-panel uk-margin-top">
                            {{ $billing_address->full_name }}<br />
                            {{ $billing_address->phone_number }}<br />
                            {{ $billing_address->address_line_1 }}<br />
                            @if($billing_address->country != 0)
                            {{ $billing_address->getArea->name }}, {{ $billing_address->zip }}, {{ $billing_address->getCity->name }}, {{ $billing_address->getRegion->name }}<br />
                            {{ $billing_address->getCountry->name }}<br />
                            @endif
                        </div>

                        <div class="uk-margin-top"><a href="{{ route('billing.address') }}" class="el-link uk-button uk-button-default">Edit</a></div>
                        @else
                        <div class="uk-margin-top"><a href="{{ route('billing.address') }}" class="el-link uk-button uk-button-default">Add</a></div>
                        @endif
                    </div>
                </div>

                <div class="uk-width-1-2@m">
                    <div class="uk-card uk-card-default uk-card-body uk-margin-remove-first-child uk-margin">
                        <h3 class="el-title uk-card-title uk-margin-top uk-margin-remove-bottom">Shipping Address</h3>
                        @if ($shipping_address != null)
                        <div class="el-content uk-panel uk-margin-top">
                            {{ $shipping_address->full_name }}<br />
                            {{ $shipping_address->phone_number }}<br />
                            {{ $shipping_address->address_line_1 }}<br />
                            @if($shipping_address->country != 0)
                            {{ $shipping_address->getArea->name }}, {{ $shipping_address->zip }}, {{ $shipping_address->getCity->name }}, {{ $shipping_address->getRegion->name }}<br />
                            {{ $shipping_address->getCountry->name }}<br />
                            @endif
                            @if($shipping_address->delivery_instructions != null) {{ $shipping_address->delivery_instructions }}<br /> @endif
                        </div>

                        <div class="uk-margin-top"><a href="{{ route('shipping.address') }}" class="el-link uk-button uk-button-default">Edit</a></div>
                        @else
                        <div class="uk-margin-top"><a href="{{ route('shipping.address') }}" class="el-link uk-button uk-button-default">Add</a></div>
                        @endif
                    </div>
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