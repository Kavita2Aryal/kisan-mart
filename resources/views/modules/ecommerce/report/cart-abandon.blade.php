@extends('layouts.app')

@section('title', 'Cart Abandon Report')

@section('content')
@php $domain = get_setting('website-domain');
@endphp

<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.cart-abandon-report-filter', ['paging' => $cart_abandons])
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">Cart Abandon Report ({{ $cart_abandons->total() }})
                        <a href="{{ route('report.export.csv.cart.abandon') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                            <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block dataTable with-export custom-table">
                        <thead>
                            <tr>
                                <th width="27">#</th>
                                <th width="50">Customer Name</th>
                                <th width="50">Customer Email</th>
                                <th width="50">Customer Phone</th>
                                <th width="50">Abandon Count</th>
                                <th width="50">Last Abandon Date</th>
                                <th width="50">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cart_abandons->count() > 0)
                            @php $i = ($cart_abandons->currentPage() - 1) * $cart_abandons->perPage(); @endphp
                            @foreach ($cart_abandons as $key => $row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <!-- <td>{{ date("Y-m-d", strtotime($row->date)) }}</td> -->
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->count }}</td>
                                <td>{{ $row->latest_date }}</td>
                                <td> <a href="{{ route('report.cart.abandon.details', ['uuid' => $key, 'id' => $row->customer_id]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary m-b-5">
                                        <i class="pg-icon m-r-5">eye</i> VIEW DETAILS
                                    </a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $cart_abandons])
        </div>
    </div>
</div>
</div>
@endsection
@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script>
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
    $(document).on('change', '.end-date', function() {
        $('.form-filter').submit();
    });
</script>
@endpush