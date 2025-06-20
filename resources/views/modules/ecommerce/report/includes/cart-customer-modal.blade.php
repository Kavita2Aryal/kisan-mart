<div class="modal-dialog modal-dialog-centered modal-lg" style="margin: 0 auto;">
    <div class="modal-content">
        <div class="modal-header clearfix">
            <span class="font-montserrat all-caps hint-text product-name-show"></span>
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
                                <th>Date</th>
                                <th>Product SKU</th>
                                <th>Variation</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Phone</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody class="details">
                            @php $i = 0; @endphp
                            @foreach($data as $row)
                                @php
                                $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td> {{ date("Y-m-d", strtotime($row->created_at)) }} </td>
                                    <td> {{ $row->product_sku }} </td>
                                    <td> {{ $row->variation->variant ?? '-' }} </td>
                                    <td> {{ $row->customer->name }} </td>
                                    <td> {{ $row->customer->email }} </td>
                                    <td> {{ $row->customer->phone }} </td>
                                    <td> {{ $row->qty }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>