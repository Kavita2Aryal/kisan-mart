@extends('layout.app')
@section('title')
Order History
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
'title' => 'Order History',
]
)

<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container">
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div>
                    <div>
                        <div class="uk-card uk-card-body uk-card-default uk-h6" style="overflow:auto;">
                            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <h5 class="uk-margin-remove">Status</h5>
                                        </th>
                                        <th>
                                            <h5 class="uk-margin-remove">Order Date</h5>
                                        </th>
                                        <th>
                                            <h5 class="uk-margin-remove">Order Code</h5>
                                        </th>
                                        <th>
                                            <h5 class="uk-margin-remove">Total</h5>
                                        </th>
                                        <th>
                                            <h5 class="uk-margin-remove">Details</h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$data->isEmpty() && $data != null)
                                    @foreach($data as $row)
                                    @php
                                    $currency = $row->exchangeRate->currency->currency ?? 'NPR';
                                    $rate = $row->exchangeRate->rate ?? 1;
                                    @endphp
                                    <tr>
                                        <td>
                                            @if($row->getCurrentStatus()->status == 1)
                                            <span class="uk-badge status-pending">PENDING</span>
                                            @elseif($row->getCurrentStatus()->status == 2)
                                            <span class="uk-badge status-cancelled">CANCELLED</span>
                                            @elseif($row->getCurrentStatus()->status == 3)
                                            <span class="uk-badge status-confirmed">CONFIRMED</span>
                                            @elseif($row->getCurrentStatus()->status == 4)
                                            <span class="uk-badge status-shipped">SHIPPED</span>
                                            @elseif($row->getCurrentStatus()->status == 5)
                                            <span class="uk-badge status-delivered">DELIVERED</span>
                                            @endif
                                        </td>
                                        <td>{{ date("M j, Y", strtotime($row->created_at)) }}</td>
                                        <td>{{ $row->order_code}}</td>
                                        <td>{!! $currency .' '. number_format($row->total, 2) !!}</td>
                                        <td>
                                            <!-- <a href="#modal-order-detail" class="uk-button uk-button-small view-order-detail" uk-toggle="" data-order-code="{{ $row->order_code }}">View</a> -->
                                            <a href="{{ route('order.detail', [$row->uuid]) }}" class="uk-button uk-button-small">View</a>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">No data to display</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if($data != null)
                        {!! $html !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-order-detail" class="uk-flex-top" uk-modal="">

</div>
@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')
<script>
    var config_order_status = "{{ ($order_status != null) ? json_encode($order_status) : null }}";
</script>
<script type="text/javascript" src="{{ asset('ecommerce/custom/order.min.js') }}"></script>
@endpush