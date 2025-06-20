@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('order.store') }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Order
                            <a href="{{ route('order.select.items') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group required form-group-default form-group-default-select2 @error('customer') has-error @enderror">
                                    <label>Select Customer</label>
                                    <select class="full-width @error('customer') error @enderror customer-lists" name="customer_id" data-placeholder="Select Customer" required>
                                    </select>
                                    @error('customer')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group required form-group-default form-group-default-select2 @error('order_status') has-error @enderror">
                                    <label>Select Order Status</label>
                                    <select class="full-width @error('order_status') error @enderror" name="order_status" data-placeholder="Select Order Status" data-init-plugin="select2" required>
                                        @forelse($order_status as $key => $row)
                                            <option value="{{ $key }}" @if($key == 1) selected @endif>{{ $row }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('order_status')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group required form-group-default form-group-default-select2 @error('payment_type') has-error @enderror">
                                    <label>Select Payment Type</label>
                                    <select class="full-width @error('payment_type') error @enderror" name="payment_type" data-placeholder="Select Payment Type" data-init-plugin="select2" required>
                                        @forelse($payment_type as $key => $row)
                                            <option value="{{ $key }}">{{ $row }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('payment_type')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label>Delivery Option</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input delivery-option" type="radio" name="delivery_option" id="home-delivery" value="1" checked>
                                    <label class="form-check-label" for="home-delivery">Home Delivery</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input delivery-option" type="radio" name="delivery_option" id="pick-up" value="2">
                                    <label class="form-check-label" for="pick-up">Pick Up At Store</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="input_delivery_charge" name="delivery_charge" value="{{ $data['delivery_charge'] }}">
                        <input type="hidden" class="input_discount_amount" name="discount_amount" value="{{ $data['discount_amount'] }}">
                        <input type="hidden" class="input_vat_amount" name="vat_amount" value="{{ $data['vat_amount'] }}">
                        <input type="hidden" class="input_vat_rate" name="vat_rate" value="{{ $data['vat_rate'] }}">
                        <input type="hidden" class="input_subtotal" name="subtotal" value="{{ $data['subtotal'] }}">
                        <input type="hidden" class="input_total" name="total" value="{{ $data['total'] }}">
                        <div class="address-parent">
                            <h5>Address Details</h5>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="shipping-address">
                                            <label class="m-b-5">Shipping Address</label>
                                            <div class="form-group form-group-default input-group required shipping-country">
                                                <div class="form-input-group">
                                                    <label>Country</label>
                                                    <select class="full-width select_ship_country" name="shipping[country]" data-placeholder="Select a Country" data-init-plugin="select2" required>
                                                        <option value="" selected>Select a Country</option>
                                                        @forelse ($countries as $row)
                                                        <option value="{{ $row->id }}" data-id="{{ $row->id }}" {{ $row->id == old('country') ? 'selected' : '' }}>{{ $row->name }}</option>
                                                        @empty
                                                        @endforelse
                                                        <option value="0" data-id="0">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-default input-group required shipping-region">
                                                <div class="form-input-group">
                                                    <label>Region</label>
                                                    <select class="full-width select_ship_region" name="shipping[region]" data-placeholder="Select a Region" data-init-plugin="select2" required>
                                                        <option value="" selected>Select a Region</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-default input-group required shipping-city">
                                                <div class="form-input-group">
                                                    <label>City</label>
                                                    <select class="full-width select_ship_city" name="shipping[city]" data-placeholder="Select a City" data-init-plugin="select2" required>
                                                        <option value="" selected>Select a City</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-default input-group required shipping-area">
                                                <div class="form-input-group">
                                                    <label>Area</label>
                                                    <select class="full-width select_ship_area" name="shipping[area]" data-placeholder="Select a Area" data-init-plugin="select2" required>
                                                        <option value="" selected>Select a Area</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-default shipping-zip">
                                                <label>Zip Code</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control ship_zip" name="shipping[zip]" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group required form-group-default shipping-address-line-1">
                                                <label>Full Address</label>
                                                <textarea class="form-control ship_address_line_1" style="height:80px;" name="shipping[address_line_1]" required autocomplete="off"></textarea>
                                            </div>
                                            <div class="form-group form-group-default">
                                                <label>Delivery Instruction</label>
                                                <textarea class="form-control delivery_instructions" style="height:80px;" name="shipping[delivery_instructions]" autocomplete="off"></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-check info m-t-0 m-b-5">
                                        <input type="checkbox" class="billing-as-shipping" name="billing_as_shipping" value="10" id="checkbox-active" checked>
                                        <label for="checkbox-active">Billing to same address</label>
                                    </div>
                                    <div class="billing-address" style="display:none;">
                                        <div class="form-group form-group-default input-group required billing-country">
                                            <div class="form-input-group">
                                                <label>Country</label>
                                                <select class="full-width select_country" name="billing[country]" data-placeholder="Select a Country" data-init-plugin="select2">
                                                    <option value="" selected>Select a Country</option>
                                                    @forelse ($countries as $row)
                                                    <option value="{{ $row->id }}" data-id="{{ $row->id }}" {{ $row->id == old('country') ? 'selected' : '' }}>{{ $row->name }}</option>
                                                    @empty
                                                    @endforelse
                                                    <option value="0" data-id="0">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-default input-group required billing-region">
                                            <div class="form-input-group">
                                                <label>Region</label>
                                                <select class="full-width select_region" name="billing[region]" data-placeholder="Select a Region" data-init-plugin="select2">
                                                    <option value="" selected>Select a Region</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-default input-group required billing-city">
                                            <div class="form-input-group">
                                                <label>City</label>
                                                <select class="full-width select_city" name="billing[city]" data-placeholder="Select a City" data-init-plugin="select2">
                                                    <option value="" selected>Select a City</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-default input-group required billing-area">
                                            <div class="form-input-group">
                                                <label>Area</label>
                                                <select class="full-width select_area" name="billing[area]" data-placeholder="Select a Area" data-init-plugin="select2">
                                                    <option value="" selected>Select a Area</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-default billing-zip">
                                            <label>Zip Code</label>
                                            <div class="controls">
                                                <input type="text bill_zip" class="form-control" name="billing[zip]" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group required form-group-default billing-address-line-1">
                                            <label>Full Address</label>
                                            <textarea class="form-control bill_address_line_1" style="height:80px;" name="billing[address_line_1]" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6"></div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    CREATE <span class="visible-x-inline m-l-5">ORDER</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Order Details
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive-block">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th style="width:100px">Product</th>
                                    <th style="width:50px">Qty</th>
                                    <th style="width:50px">Price</th>
                                    <th style="width:50px">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach($products as $row)
                                    @php $i++; @endphp
                                    <tr>
                                        <td style="width:10px">{{ $i }}</td>
                                        <td style="width:100px" class="text-wrap">{{ ucwords($row['product_name']) }}<br>{{ ($row['selected_variant'] ?? '') }}</td>
                                        <td style="width:50px">{{ $row['qty'] }}</td>
                                        <td style="width:50px">{{ 'NPR '. number_format($row['price'], 2) }}</td>
                                        <td style="width:50px">{{ 'NPR '. number_format(($row['price'] * $row['qty']), 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row p-r-15 m-t-5">
                            <div class="col-md-7"></div>
                            <div class="col-md-5">
                                <div class="p-l-15 p-r-15">
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr>
                                                <td class="col-md-6">
                                                    <span>Sub Total:</span>
                                                </td>
                                                <td class="col-md-6 text-right">
                                                    <span class="subtotal-amount">{{ 'NPR ' .number_format($data['subtotal'], 2) }}</span>
                                                </td>
                                            </tr>
                                            <tr class="discount-amount-item" @if($data['discount_amount'] <= 0) style="display:none;" @endif>
                                                <td class="col-md-6">
                                                    <span>Discount Amount:</span>
                                                </td>
                                                <td class="col-md-6 text-right">
                                                    <span class="discount_amount_text">{{ 'NPR ' .number_format($data['discount_amount'], 2) }}</span>
                                                </td>
                                            </tr>
                                            <tr class="vat-amount-item" @if($data['vat_amount'] <= 0) style="display:none;" @endif>
                                                <td class="col-md-6">
                                                    <span>VAT Amount:</span>
                                                    <span class="font-montserrat"></span>
                                                </td>
                                                <td class="col-md-6 text-right">
                                                    <span class="vat_amount_text">{{ 'NPR ' .number_format($data['vat_amount'], 2) }}</span>
                                                </td>
                                            </tr>
                                            <tr class="delivery-charge-item" @if($data['delivery_charge'] <= 0) style="display:none;" @endif>
                                                <td class="col-md-6">
                                                    <span class="text-wrap">Shipping & Handling Fee:</span>
                                                </td>
                                                <td class="col-md-6 text-right">
                                                    <span class="delivery_charge_text">{{ 'NPR ' .number_format($data['delivery_charge'], 2) }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-6">
                                                    <span>Grand Total:</span>
                                                </td>
                                                <td class="col-md-6 text-right">
                                                    <strong><span class="text-primary no-margin font-montserrat grand_total_text">{{ 'NPR ' .number_format($data['total'], 2) }}</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@push('styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script>
    var countries = "{{ $countries }}",
        regions = "{{ $regions }}",
        cities = "{{ $cities }}",
        areas = "{{ $areas }}",
        sub_total = '{{ $data["subtotal"] }}',
        discount_amount = '{{ $data["discount_amount"] }}',
        vat_rate = '{{ $data["vat_rate"] }}',
        vat_amount = '{{ $data["vat_amount"] }}';

    $(document).ready(function() {
        $('[data-init-plugin=select2]').select2({});
    });

    $('.customer-lists').select2({
        placeholder: 'Select Customer',
        ajax: {
            url: "{{ route('customer.search') }}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
            },
            cache: true
        }
    });
</script>
<script src="{{ asset('assets/js/order-manage.min.js') }}" type="text/javascript"></script>
@endpush