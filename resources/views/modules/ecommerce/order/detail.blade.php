@extends('layouts.app')

@section('title', 'Order Manager')

@section('content')
@php
$currency = $order->exchange_rate_id > 0 ? $order->exchangeRate->currency->currency : 'NPR';
$rate = $order->exchange_rate_id > 0 ? $order->exchangeRate->rate : 1;
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-default m-t-20 m-b-0">
                <div class="card-header">
                    <a href="{{ route('order.export.pdf', [$order->uuid]) }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                        <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> PDF
                    </a>
                    @if($order_status != null && $order_status[$order->current_status] == "Pending")
                    <a class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 m-r-10 text-success btn-order-status pull-right" data-type="confirm" data-code="{{ $order->order_code }}" href="javascript:void(0);">
                        <i class="pg-icon m-r-5">tick</i><span class="visible-x-inline m-r-5">CONFIRM</span> ORDER
                    </a>
                    @endif
                    <a href="{{ route('order.pending') }}" class="m-r-10 normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                </div>
                <div class="card-body" style="padding-top: 0px;">
                    <div>
                        <div class="pull-left">
                            <p class="text-left">ORDER PLACED ON: <span class="text-success">{{ date("F j, Y", strtotime($order->created_at)) }}</span> </p>
                            @if($order->promo_code != null)
                            <p class="text-left">PROMOCODE: <span class="text-danger"> {{ $order->getPromoCode->code}} </span> </p>
                            @endif
                            @if($order->gift_voucher != null)
                            <p class="text-left">GIFT VOUCHER: <span class="text-danger"> {{ $order->getGiftVoucher->code}} </span> </p>
                            @endif
                        </div>
                        <div class="pull-right">
                            <h5 class="font-montserrat all-caps hint-text text-center">{{ $order->order_code }}</h5>
                            <p class="text-right">STATUS: <span class="text-warning"> {{ $order_status[$order->current_status] }} </span> </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-4 p-l-0 col-sm-height sm-no-padding">
                                <p class="m-b-0 small underline">Billing Detail</p>
                                @if($order_billing_address)
                                    <address class="no-margin">
                                        @if($order_billing_address->phone_number != null)
                                        <strong class="phone-number">{{ $order_billing_address->phone_number }}</strong>
                                        <br>
                                        @endif
                                        <span class="address-line-1">{{ $order_billing_address->address_line_1 }}</span>
                                        @if($order_billing_address->country != 0)
                                        <span class="address-line-2"> {{ $order_billing_address->address_line_2 }} </span><br>
                                        <span class="city">{{ $order_billing_address->getCity->name }},</span>
                                        <span class="region">{{ $order_billing_address->getRegion->name }},</span>
                                        <span class="area">{{ $order_billing_address->getArea->name }},</span>
                                        <span class="country">{{ $order_billing_address->getCountry->name }}</span>
                                        @endif
                                    </address>
                                @endif
                            </div>
                            <div class="col-lg-4 col-sm-height sm-no-padding">
                                <p class="m-b-0 small underline">Shipping Detail</p>
                                @if($order_shipping_address)
                                    <address class="no-margin">
                                        @if($order_shipping_address->phone_number != null)
                                        <strong class="phone-number">{{ $order_shipping_address->phone_number }}</strong>
                                        <br>
                                        @endif
                                        <span class="address-line-1">{{ $order_shipping_address->address_line_1 }}</span>
                                        @if($order_shipping_address->country != 0)
                                        <span class="address-line-2"> {{ $order_shipping_address->address_line_2 }} </span><br>
                                        <span class="city">{{ $order_shipping_address->getCity->name }},</span>
                                        <span class="region">{{ $order_shipping_address->getRegion->name }},</span>
                                        <span class="area">{{ $order_shipping_address->getArea->name }},</span>
                                        <span class="country">{{ $order_shipping_address->getCountry->name }}</span>
                                        @endif
                                        <br><span class="delivery-instruction">{{ $order_shipping_address->delivery_instructions }}</span>
                                    </address>
                                @endif
                            </div>
                            <div class="col-lg-4 p-r-0 col-sm-height sm-no-padding">
                                <p class="m-b-0 small underline text-right">Customer Detail</p>
                                <address class="no-margin text-right pull-right">
                                    <strong>{{ $order->customer->name }}</strong>
                                    @if($order->customer->email != null)
                                    <br><span>{{ $order->customer->email }}</span>
                                    @endif
                                    @if($order->customer->phone != null)
                                    <br><span>{{ $order->customer->phone }}</span>
                                    @endif
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 m-t-20">
                        <div class="row">
                            <div class="col-lg-12 p-r-0 col-sm-height sm-no-padding">
                                @if(count($order->cancelled_order_details) > 0)
                                <a class="btn btn-link btn-link-fix m-b-5 text-danger btn-view-cancel-order-detail pull-right" data-toggle="modal" data-target="#cancelled-item-modal" data-code="{{ $order->order_code }}" href="javascript:void(0);">
                                    <i class="pg-icon m-r-5">trash</i><span class="visible-x-inline m-r-5">REMOVED</span> ITEMS
                                </a>
                                @endif
                                @if($order_status != null && $order_status[$order->current_status] == "Pending")
                                <a class="btn btn-link btn-link-fix m-b-5 m-r-10 text-primary pull-right" href="{{ route('order.add.items', [$order->uuid]) }}">
                                    <i class="pg-icon m-r-5">plus</i><span class="visible-x-inline m-r-5">ADD</span> ITEMS
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(count($gift_voucher_details) > 0)
                    <div class="table-responsive table-invoice">
                        <table class="table m-t-25">
                            <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Gift Voucher</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Value</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Sub Total</th>
                                    @if($order_status[$order->current_status] == "Pending")
                                    <th class="text-center">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($gift_voucher_details as $row)
                                @php $i++; @endphp
                                <tr>
                                    <td> {{$i}} </td>
                                    <td class="text-center"> {{ $row->gift_voucher->code }} </td>
                                    <td class="text-center"> {{ $row->gift_voucher->title }} </td>
                                    <td class="text-center"> {{ $row->qty }} </td>
                                    <td class="text-center"> {{ $currency . ' ' .number_format($row->gift_voucher->value, 2) }} </td>
                                    <td class="text-center"> {{ $currency . ' ' .number_format($row->price, 2) }} </td>
                                    <td class="text-center"> {{ $currency . ' ' .number_format($row->price*$row->qty, 2) }} </td>
                                    @if($order_status[$order->current_status] == "Pending")
                                    <td class="text-center">
                                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 btn-remove-order text-danger" data-order-id="{{ $order->id }}" data-order-detail-id="{{ $row->id }}" data-order-detail-sku="{{ $row->product_sku }}">
                                            <i class="pg-icon m-r-5">cross</i>
                                            <span>REMOVE</span>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    @if($order->gift_voucher_option != null)
                    <p>Gift Voucher Option: <span class="text-danger"> {{ $gift_voucher_options[$order->gift_voucher_option] }} </span> </p>
                    @endif
                    @if(count($product_details) > 0)
                    <div class="table-responsive table-invoice">
                        <table class="table m-t-25">
                            <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="text-center">SKU</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Quantity</th>
                                    <!-- <th class="text-center">Stock Available</th> -->
                                    <th class="text-center">Actual Price</th>
                                    <th class="text-center">Offer Price</th>
                                    <th class="text-center">Sub Total</th>
                                    @if($order_status[$order->current_status] == "Pending")
                                    <th class="text-center">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($product_details as $row)
                                @php $i++; @endphp
                                <tr>
                                    <td> {{$i}} </td>
                                    <td class="text-center">{{ $row->variation->sku }}</td>
                                    <td class="text-center"> {{ $row->product->name }} @if($row->variation->variant != null)<br><strong>({{ $row->variation->variant}})</strong>@endif</td>
                                    <td class="text-center">
                                        @if($order_status[$order->current_status] == "Pending")
                                        <select class="quantity-option" data-id="{{ $row->id }}">
                                            @if($row->variation->qty > $row->qty)
                                            @php $value = $row->variation->qty; @endphp
                                            @else
                                            @php $value = $row->qty; @endphp
                                            @endif
                                            @php $value = 10; @endphp
                                            @for($j = 1; $j <= $value; $j++) <option value="{{ $j }}" @if($row->qty == $j) selected @endif>{{ $j }}</option>
                                                @endfor
                                        </select>
                                        <input type="hidden" class="product-qty-{{ $row->id }}" value="{{ $row->qty }}">
                                        @else
                                        {{ $row->qty }}
                                        @endif
                                    </td>
                                    <!-- <td class="text-center"> {{ $row->variation->qty }} </td> -->
                                    <td class="text-center"> {{ $currency . ' ' .number_format($row->variation->selling_price/$rate, 2) }}</td>
                                    <td class="text-center"> {{ $currency . ' ' .number_format($row->price, 2) }} </td>
                                    <td class="text-center"> {{ $currency . ' ' .number_format($row->price*$row->qty, 2) }} </td>
                                    @if($order_status[$order->current_status] == "Pending")
                                    <td class="text-center">
                                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-warning btn-update-order" data-order-id="{{ $order->id }}" data-order-detail-id="{{ $row->id }}" data-order-detail-sku="{{ $row->product_sku }}">
                                            <i class="pg-icon m-r-5">pencil</i>
                                            <span>UPDATE</span>
                                        </button>
                                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 btn-remove-order text-danger" data-order-id="{{ $order->id }}" data-order-detail-id="{{ $row->id }}" data-order-detail-sku="{{ $row->product_sku }}">
                                            <i class="pg-icon m-r-5">cross</i>
                                            <span>REMOVE</span>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <br>
                    <div class="row p-r-15">
                        <div class="col-md-7"></div>
                        <div class="col-md-5 b-a b-grey">
                            <div class="p-l-15 p-r-15">
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <td class="col-md-6">
                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Sub Total:</span>
                                            </td>
                                            <td class="col-md-6 text-right">
                                                <span class="subtotal-amount">{{ $currency . ' ' .number_format($order->sub_total, 2) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-6">
                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Discount Amount:</span>
                                            </td>
                                            <td class="col-md-6 text-right">
                                                <span class="discount-amount">{{ $currency . ' ' .number_format($order->discount_amount, 2) }}</span>
                                            </td>
                                        </tr>
                                        @if($order->vat_amount > 0 && $order->vat_rate != null)
                                        <tr>
                                            <td class="col-md-6">
                                                <span class="m-l-10 font-montserrat fs-11 all-caps">VAT Amount:</span>
                                                <span class="font-montserrat">({{$order->vat_rate}}%)</span>
                                            </td>
                                            <td class="col-md-6 text-right">
                                                <span class="vat-amount">{{ $currency . ' ' .number_format($order->vat_amount, 2) }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="col-md-6">
                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Shipping & Handling Fee:</span>
                                            </td>
                                            <td class="col-md-6 text-right">
                                                <span class="delivery-charge-amount">{{ $currency . ' ' .number_format($order->delivery_charge, 2) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-6">
                                                <span class="m-l-10 font-montserrat fs-11 all-caps">Grand Total:</span>
                                            </td>
                                            <td class="col-md-6 text-right">
                                                <strong><span class="text-primary no-margin font-montserrat total-amount">{{ $currency . ' ' .number_format($order->total, 2) }}</span></strong>
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
    <div class="modal" id="cancelled-item-modal" data-backdrop="static" style="padding: 0 !important;">
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@push('scripts')
<script type="text/javascript">
    var admin_get_cancel_order_detail_url = "{{ route('order.cancelled.get.detail') }}";
    var confirm_order_url = "{{ route('order.confirm.save') }}";
    var remove_order_detail_url = "{{ route('order.detail.remove') }}";
    var update_order_detail_url = "{{ route('order.detail.update') }}";
    var order_detail_count = "{{ count($gift_voucher_details) + count($product_details) }}"
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/order.min.js') }}" type="text/javascript"></script>
@endpush