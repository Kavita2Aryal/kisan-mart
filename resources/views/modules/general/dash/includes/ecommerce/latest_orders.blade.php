<div class="ar-2-3">
    <div class="widget-11 card">
        <div class="card-header">
            <div class="card-title full-width">
                Latest Orders
            </div>
        </div>
        @if ($latest_orders->count() > 0)
            <div class="widget-11-table scroll-ing" style="overflow-y: auto; height: 400px;">
                <table class="table table-condensed table-hover">
                    <thead>
                        <th width="75">Order Code</th>
                        <th width="75" class="text-right">Customer Details</th>
                        <th width="75" class="text-right">Total Amount</th>
                        <th width="75" class="text-right">Payment Type</th>
                        <th width="75" class="text-right">Ordered On</th>
                    </thead>
                    <tbody>
                            @foreach ($latest_orders as $row)
                            @php
                            $currency = $row->exchange_rate_id > 0 ? $row->exchangeRate->currency->currency : 'NPR';
                            $payment_type = get_list_group('payment_type');
                            $payment_status = get_list_group('payment-status');
                            @endphp
                            <tr>
                                <td width="75" class="fs-12">{{ $row->order_code }}</td>
                                <td width="75" class="text-right b-l b-dashed b-grey">
                                    <span class="font-montserrat ">{{ $row->customer->name }}<br>{{ $row->customer->email }}<br>{{$row->customer->phone }}</span>
                                </td>
                                <td width="75" class="text-right b-l b-dashed b-grey">
                                    <span class="font-montserrat "> {{ $currency .' '. number_format($row->total, 2) }} </span>
                                </td>
                                <td width="75" class="text-right b-l b-dashed b-grey">
                                    <span class="font-montserrat ">{{ ($row->payment_type != null) ? $payment_type[$row->payment_type] : 'N/A' }}</span>
                                </td>
                                <td width="75" class="text-right b-l b-dashed b-grey">
                                    <span class="font-montserrat ">{{ $row->created_at }}</span>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-t-15 p-b-15 p-l-20 p-r-20">
                <p class="small no-margin pull-right">
                    <a href="{{ route('order.pending') }}" class="hint-text font-montserrat"><strong> View All </strong></a>
                </p>
            </div>
        @else
        <div class="widget-11-table" style="overflow-y: auto; height: 100px;">
            <div class="p-t-15 p-b-15 p-l-20 p-r-20">
                <p class="small no-margin">
                    <span class="hint-text font-montserrat"><strong>No Latest Orders!</strong></span>
                </p>
            </div>
        </div>
        @endif
    </div>
</div>