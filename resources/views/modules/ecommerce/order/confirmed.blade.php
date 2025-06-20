@extends('layouts.app')

@section('title', 'Order Manager')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card card-borderless">
                @include('modules.ecommerce.order.includes.header')
                <div class="tab-content">
                    <div class="tab-pane active" id="pendingOrder">
                        <table class="table table-hover table-responsive-block">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Code</th>
                                    <th>Customer Details</th>
                                    <th>Total Amount</th>
                                    <th>Payment Type</th>
                                    <th>Ordered On</th>
                                    <th>Confirmed On</th>
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
                                @endphp
                                <tr data-code="{{ $row->order_code }}">
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->order_code }}</td>
                                    <td>{{ $row->customer->name }} 
                                        @if($row->customer->email != null)<br>{{ $row->customer->email }}@endif
                                        @if($row->customer->phone != null)<br>{{$row->customer->phone }}@endif
                                    </td>
                                    <td>{{ $currency .' '. number_format($row->total, 2) }}</td>
                                    <td>
                                        <span><strong>{{ $payment_type[$row->payment_type] }}</strong></span>
                                    </td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>{{ $row->status_created_at }}</td>
                                    <td>
                                        <a class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-info btn-order-status" data-type="ship" data-code="{{ $row->order_code }}" data-index="{{$i}}" href="javascript:void(0);">
                                            <i class="fa fa-pencil"></i> {{ __('SHIP ORDER') }}
                                        </a>
                                        <a class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger btn-order-status" data-type="cancel" data-code="{{ $row->order_code }}" data-index="{{$i}}" href="javascript:void(0);">
                                            <i class="fa fa-pencil"></i> {{ __('CANCEL ORDER') }}
                                        </a>
                                        <a class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary" href="{{ route('order.detail', [$row->uuid]) }}">
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
            </div>

            @include('includes.pagination', ['page' => $orders])

        </div>
    </div>
</div>
<div class="modal" id="cancelled-item-modal" data-backdrop="static" style="padding: 0 !important;">
</div>
@include('modules.ecommerce.order.includes.modal')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script type="text/javascript">
    var ship_order_url = "{{ route('order.ship.save') }}";
    var cancel_order_url = "{{ route('order.cancel.save') }}";
    var admin_get_order_detail_url = "{{ route('order.get.detail') }}";
    var admin_get_cancel_order_detail_url = "{{ route('order.cancelled.get.detail') }}";
    var config_currency = "{{ config('app.addons_ecommerce.currency') }}";
    var remove_order_detail_url = "{{ route('order.detail.remove') }}";
    var update_order_detail_url = "{{ route('order.detail.update') }}";
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/order.min.js') }}" type="text/javascript"></script>
@endpush