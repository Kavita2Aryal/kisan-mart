@php
$currency = $order->exchange_rate_id > 0 ? $order->exchangeRate->currency->currency : 'NPR';
$rate = $order->exchange_rate_id > 0 ? $order->exchangeRate->rate : 1;
@endphp
<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content-wrapper">
        <div class="modal-content">
            <div class="modal-header clearfix m-b-10">
                <button type="button" class="close text-danger btn-close-modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid container-fixed-lg">
                    <div class="card card-default m-t-20">
                        <div class="card-body" style="padding-top: 0px;">
                            <div class="invoice">
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
                                        <p class="text-right">CURRENT STATUS: <span class="text-warning"> {{ $order_status[$order->current_status] }} </span> </p>
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
                                                <th class="text-center">Actual Price</th>
                                                <th class="text-center">Offer Price</th>
                                                <th class="text-center">Sub Total</th>
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
                                                <td class="text-center"> {{ $row->qty }} </td>
                                                <td class="text-center"> {{ $currency . ' ' .number_format($row->variation->selling_price/$rate, 2) }}</td>
                                                <td class="text-center"> {{ $currency . ' ' .number_format($row->price, 2) }} </td>
                                                <td class="text-center"> {{ $currency . ' ' .number_format($row->price*$row->qty, 2) }} </td>
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
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Order Status History</h5>
                                        <div class="table-responsive table-invoice b-a b-grey">
                                            <table class="table m-t-25">
                                                <thead>
                                                    <tr>
                                                        <th class="">#</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Date</th>
                                                        <th class="text-center">Updated By</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 0; @endphp
                                                    @foreach($order_status_lists as $row)
                                                    @php $i++; @endphp
                                                    <tr>
                                                        <td> {{$i}} </td>
                                                        <td class="text-center">{{ $order_status[$row->status] }}</td>
                                                        <td class="text-center"> {{ $row->created_at }}</td>
                                                        <td class="text-center"> {{ ($row->user != null) ? $row->user->name : '-' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>