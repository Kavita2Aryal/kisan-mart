@extends('layouts.app')

@section('title', 'Customer')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            Customers ({{ $customers->total() }})
                            <a href="{{ route('customer.export.csv') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                            </a>
                            <a href="{{ route('customer.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">CUSTOMER</span>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Customer">
                            @if ($customers->count() > 0)
                            @php $i = ($customers->currentPage() - 1) * $customers->perPage(); @endphp
                            @foreach ($customers as $customer)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? 'N/A' }}</td>
                                <td class="change-status">
                                    @if ($customer->is_active == 10)
                                    <strong class="text-success">ACTIVE<strong>
                                            @else
                                            <strong class="text-danger">INACTIVE<strong>
                                                    @endif
                                </td>
                                <td>
                                    {{ $customer->user_id != null ? $customer->user->name : '-' }}
                                </td>
                                <td>{{ $customer->created_at }}</td>    
                                <td>
                                    <a href="{{ route('customer.edit', [$customer->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('customer.change.status', [$customer->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $customer->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                    @if($customer->orders->count() > 0)
                                    <a href="{{ route('customer.order', [$customer->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-warning m-b-5">
                                        <i class="pg-icon m-r-5">clock</i> ORDER HISTORY
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="9">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $customers])
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>
@endpush