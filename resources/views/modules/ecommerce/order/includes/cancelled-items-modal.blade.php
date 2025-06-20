@php 
    $currency = $data->exchange_rate_id > 0 ? $data->exchangeRate->currency->currency : 'NPR';
    $rate =  $data->exchange_rate_id > 0 ? $data->exchangeRate->rate : 1;
@endphp
<div class="modal-dialog modal-dialog-centered modal-lg" style="margin: 0 auto;">
    <div class="modal-content">
        <div class="modal-header clearfix">
            <h5 class="font-montserrat all-caps hint-text">Cancelled Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="table-responsive table-invoice">
                    <table class="table m-t-25">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Actual Price</th>
                                <th>Offer Price</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="cancel-order-detail-body">
                            @php $i = 0; @endphp
                            @foreach($data_details as $row)
                                @php
                                $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td> {{ $row->product->name }} </td>
                                    <td> {{ $row->qty }} </td>
                                    <td> {{ $currency . ' ' .number_format($row->variation->selling_price, 2) }} </td>
                                    <td> {{ $currency . ' ' .number_format($row->price, 2) }} </td>
                                    <td> {{ $row->remark }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>