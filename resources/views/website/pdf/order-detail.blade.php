@php
$currency = $data->exchange_rate_id > 0 ? $data->exchangeRate->currency->currency : 'NPR';
$rate = $data->exchange_rate_id > 0 ? $data->exchangeRate->rate : 1;
$order_status = get_list_group('order-status');
@endphp
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Order Details</title>
        <style type="text/css">
            body
            {
                font-family: Arial;
                font-size: 12pt;
            }
            table
            {
                border: 1px solid #ccc;
                border-collapse: collapse;
            }
            table th
            {
                background-color: #F7F7F7;
                color: #333;
                font-weight: bold;
            }
            table th, table td
            {
                padding: 5px;
                border: 1px solid #ccc;
            }
            .text-center
            {
                text-align: center;
            }
            .text-right
            {
                text-align: right;
            }
            .column 
            {
                float: left;
                width: 50%;
                padding: 10px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }
            .header {
                top: 0;
                width: 100%;
                text-align: center;
            }
            .footer {
                position: fixed;
                left: 0;
                bottom: 10;
                width: 100%;
                text-align: center;
            }
            .nowrap{
                white-space: nowrap;
            }

        </style>
    </head>
    <body>
        <div class="header">
            <div class="container">
                <img src="{{ asset('ecommerce/image/logo.svg') }}" alt="" width="140">
            </div>
        </div>
        <hr>
        <div class="container-fluid container-fixed-lg">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="column">
                        <span>Dear {{ $data->customer->name }},</span><br>
                        <span>Your order detail for order code # <strong>{{ $data->order_code }}</strong></span>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="column">
                            <p><strong>Customer Detail</strong></p>
                            <span>{{ $data->customer->name }}</span><br>
                            <span>{{ $data->customer->email }}</span><br>
                            <span>{{ $data->customer->phone }}</span>
                        </div>
                        <div class="column">
                            <p><strong>Order Detail</strong></p>
                            <span>Date: {{ date("F j, Y", strtotime($data->created_at)) }}</span><br>
                            <span>Status: {{ $order_status[$data->current_status] }}</span><br>
                            @if($data->promo_code != null)
                            <span> Promo Code: {{ $data->getPromoCode->code}} </span>
                            @endif
                            @if($data->gift_voucher != null)
                            <span> Gift Voucher: {{ $data->getGiftVoucher->code}} </span>
                            @endif
                        </div>
                    </div>
                    @if($data->billing != null && $data->shipping != null)
                        <div class="row">
                            <div class="column">
                                <P><strong>Billing Detail</strong></p>
                                    <span>{{ $data->billing->phone_number ?? 0 }}</span>
                                    <br>
                                    <span>{{ $data->billing->address_line_1 ?? '-' }}</span>
                                    @if($data->billing->country != 0)
                                    <span> {{ $data->billing->address_line_2 }} </span><br>
                                    <span>{{ $data->billing->getCity->name }},</span>
                                    <span>{{ $data->billing->getRegion->name }},</span>
                                    <span>{{ $data->billing->getArea->name }},</span>
                                    <span>{{ $data->billing->getCountry->name }}</span>
                                    @endif
                            </div>
                            <div class="column">
                                <p><strong>Shippping Detail</strong></p>
                                    <span>{{ $data->shipping->phone_number ?? 0}}</span>
                                    <br>
                                    <span>{{ $data->shipping->address_line_1 ?? '-'}}</span>
                                    @if($data->shipping->country != 0)
                                    <span> {{ $data->shipping->address_line_2 }} </span><br>
                                    <span>{{ $data->shipping->getCity->name }},</span>
                                    <span>{{ $data->shipping->getRegion->name }},</span>
                                    <span>{{ $data->shipping->getArea->name }},</span>
                                    <span>{{ $data->shipping->getCountry->name }}</span>
                                    @endif
                                    <br><span>{{ $data->shipping->delivery_instructions }}</span>
                            </div>
                        </div>
                    @endif
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <table style="width:100%">
                                <thead> 
                                    <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($data->details as $row)
                                        @php $i++; @endphp
                                        @if($row->product_id != null)
                                        <tr>
                                            <td> {{$i}} </td>
                                            <td> {{ ucwords($row->product->name) }} @if($row->variation->variant != null)<br><strong>({{ $row->variation->variant}})</strong>@endif</td>
                                            <td class="text-center"> {{ $row->qty }} </td>
                                            <td class="text-center"> {{ $currency . ' ' .number_format($row->price, 2) }} </td>
                                            <td class="text-center"> {{ $currency . ' ' .number_format($row->price*$row->qty, 2) }} </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td> {{$i}} </td>
                                            <td> {{ ucwords($row->gift_voucher->title) }} </td>
                                            <td class="text-center"> {{ $row->qty }} </td>
                                            <td class="text-center"> {{ $currency . ' ' .number_format($row->price, 2) }} </td>
                                            <td class="text-center"> {{ $currency . ' ' .number_format($row->price*$row->qty, 2) }} </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr>
                                            <td class="text-right nowrap" colspan="3">
                                                <span>Sub Total:</span>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <span>{{ $currency . ' ' .number_format($data->sub_total, 2) }}</span>
                                            </td>
                                        </tr>
                                        @if($data->vat_amount > 0 && $data->vat_rate != null)
                                        <tr>
                                            <td class="text-right nowrap" colspan="3">
                                                <span>VAT Amount:</span>
                                                <span>({{$data->vat_rate}}%)</span>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <span>{{ $currency . ' ' .number_format($data->vat_amount, 2) }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                        @if($data->discount_amount > 0)
                                        <tr>
                                            <td class="text-right nowrap" colspan="3">
                                                <span>Discount Amount:</span>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <span>{{ $currency . ' ' .number_format($data->discount_amount, 2) }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="text-right nowrap" colspan="3">
                                                <span>Shipping Fee:</span>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <span>{{ $currency . ' ' .number_format($data->delivery_charge, 2) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right nowrap" colspan="3">
                                                <span>Grand Total:</span>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                <strong><span>{{ $currency . ' ' .number_format($data->total, 2) }}</span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <hr>
            <p>© {{ date('Y') }} {!! $settings['contact-title'] !!} | {!! $settings['contact-address'] !!} | {!! $settings['contact-phone'] !!}</p>
        </div>
    </body>
</html>