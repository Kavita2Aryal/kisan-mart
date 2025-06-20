@extends('layout.app')
@section('title')
Customer Billing Details
@endsection
@push('seo')
@include('includes.seo.seo',
[
'seo' => null,
'url' => url()->current()
]
)
@endpush
@php
$name = $data->full_name ?? Auth::user()->name;
$phone = $data->phone_number ?? Auth::user()->phone;
$selected_data = $data ?? null;
$selected_area = $data->area ?? '';
$selected_city = $data->city ?? '';
$selected_region = $data->region ?? '';
$selected_country = $data->country ?? '';
$selected_full_address = $data->address_line_1 ?? '';
$selected_zip_code = $data->zip ?? '';
@endphp

@section('frontend-content')
@include('includes.cms.headers.header_1')

@include('includes.customer-nav',
[
'title' => 'Billing Details'
]
)
<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container">
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div>
                    <h3>Billing Address</h3>
                    <div>
                        <form class="uk-form-stacked" action="{{ route('billing.address.save') }}" method="POST">
                            @csrf()
                            <div class="uk-margin uk-child-width-expand@s uk-grid-small" uk-grid>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="name">Full Name</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" required id="name" name="full_name" type="text" value="{{ $name }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="phone">Phone Number</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" required id="phone" name="phone_number" type="text" value="{{ $phone }}" />
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="country">Country</label>
                                <div class="uk-form-controls">
                                    <select class="uk-input address-options edit_select_country" required name="country">
                                        <option value="">Select Country</option>
                                        @isset($countries)
                                        @foreach($countries as $country)
                                        <option value='{{ $country->id }}' data-id="{{ $country->id }}" @if($selected_country==$country->id) selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                        @endisset
                                        <option value="0" data-id="0" @if($selected_country==0) selected @endif>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin billing-region" style="{{ ($selected_country == 0) ? 'display:none;' : '' }}">
                                <label class="uk-form-label" for="region">Region</label>
                                <div class="uk-form-controls">
                                    <select class="uk-input address-options edit_select_region" name="region" required>
                                        <option value="">Select Region</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin billing-city" style="{{ ($selected_country == 0) ? 'display:none;' : '' }}">
                                <label class="uk-form-label" for="city">City</label>
                                <div class="uk-form-controls">
                                    <select class="uk-input address-options edit_select_city" name="city" required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin billing-area" style="{{ ($selected_country == 0) ? 'display:none;' : '' }}">
                                <label class="uk-form-label" for="area">Area</label>
                                <div class="uk-form-controls">
                                    <select class="uk-input address-options edit_select_area" name="area" required>
                                        <option value="">Select Area</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin billing-zip" style="{{ ($selected_country == 0) ? 'display:none;' : '' }}">
                                <label class="uk-form-label" for="zip-code">Zip Code / Postal Code</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input address-options edit_select_zip" id="zip-code" name="zip" type="number" placeholder="Zip Code/Postal Code" value="{{ $selected_zip_code }}" />
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="full_address">Full Address</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" required id="full_address" name="address_line_1" type="text" placeholder="Full Address" rows="5">{{ $selected_full_address }}</textarea>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <button class="uk-button uk-button-primary uk-button-large">SAVE</button>
                            </div>
                        </form>
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
<script type="text/javascript">
    var shipping_details = "{{ $selected_data }}",
        selected_country = "{{ $selected_country }}",
        selected_region = "{{ $selected_region }}",
        selected_city = "{{ $selected_city }}",
        selected_area = "{{ $selected_area }}",
        countries = "{{ $countries }}",
        cities = "{{ $cities }}",
        areas = "{{ $areas }}",
        regions = "{{ $regions }}";
</script>
<script type="text/javascript" src="{{ asset('ecommerce/custom/billing-shipping.min.js') }}"></script>
@endpush