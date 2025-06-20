@extends('layouts.app')

@section('title', 'Order History')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">Order History</h5>
                        <a href="{{ route('customer.index') }}" class="m-r-10 normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        <span>
                            {{ $customer->name }} @if($customer->email != null) / {{ $customer->email }}@endif @if($customer->phone != null) / {{$customer->phone }}@endif
                        </span>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Code</th>
                                <th>Status</th>
                                <th>Total Amount</th>
                                <th>Payment Type</th>
                                <th>Ordered On</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Product">
                            @if ($orders->count() > 0)
                            @php $i = ($orders->currentPage() - 1) * $orders->perPage(); @endphp
                            @foreach ($orders as $row)
                            @php
                            $i++;
                            $currency = $row->exchange_rate_id > 0 ? $row->exchangeRate->currency->currency : 'NPR';
                            $payment_type = get_list_group('payment_type');
                            $status = get_list_group('order-status');
                            @endphp
                            <tr data-code="{{ $row->order_code }}">
                                <td>{{ $i }}</td>
                                <td>{{ $row->order_code }}</td>
                                <td><strong>{{ strtoupper($status[$row->current_status]) }}</strong></td>
                                <td>{{ $currency .' '. number_format($row->total, 2) }}</td>
                                <td>
                                    <span><strong>{{ ($row->payment_type != null) ? $payment_type[$row->payment_type] : 'N/A' }}</strong></span>
                                </td>
                                <td>{{ $row->created_at }}</td>
                                <td><a class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary btn-view-customer-order-detail" data-code="{{ $row->order_code }}" href="javascript:void(0)">
                                            <i class="fa fa-eye"></i> {{ __('VIEW DETAILS') }}
                                        </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="text-center">No orders to display.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $orders])
        </div>
    </div>
    <div class="modal fade slide-up" id="order-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
    </div>
</div>
@endsection

@push('styles')
@endpush

@push('scripts')
<script>
    var customer_get_order_detail_url = "{{ route('customer.order.detail') }}"
    $(document).on('click', '.btn-view-customer-order-detail', function () {
        var code = $(this).data('code');
        $.ajax({
            type: 'get',
            url: customer_get_order_detail_url,
            data: { code: code },
            async: false,
            success: function (response) {
                if (response.status) {
                    $('#order-detail-modal').html(response.html);
                    $('#order-detail-modal').modal('show');
                }
            }
        });
    })
    $(document).on('click', '.btn-close-modal', function () {
        $('#order-detail-modal').modal('toggle');
    });
</script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}" type="text/javascript"></script>
@endpush