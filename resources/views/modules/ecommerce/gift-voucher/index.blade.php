@extends('layouts.app')

@section('title', 'Gift Voucher')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            Gift Vouchers ({{ $gift_vouchers->total() }})
                            <a href="{{ route('gift.voucher.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">GIFT VOUCHER</span>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Title</th>
                                <th>Alias</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="gift_voucher">
                            @if ($gift_vouchers->count() > 0)
                            @php $i = ($gift_vouchers->currentPage() - 1) * $gift_vouchers->perPage(); @endphp
                            @foreach ($gift_vouchers as $gift_voucher)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $gift_voucher->code }}</td>
                                <td>{{ $gift_voucher->title }}</td>
                                <td>{{ $gift_voucher->alias != null ? $url. $gift_voucher->alias->alias : 'N/A' }}</td>
                                <td><strong class="text-success">{{ $gift_voucher->start_date }}</strong>
                                    <strong> - </strong>
                                    @if ($gift_voucher->end_date)<strong class="text-danger">{{ $gift_voucher->end_date }}</strong>@endif
                                </td>
                                <td class="change-status">
                                    @if ($gift_voucher->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $gift_voucher->user->name }}</td>
                                <td>{{ $gift_voucher->updated_at }}</td>
                                <td>
                                    <a href="{{ route('gift.voucher.edit', [$gift_voucher->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('gift.voucher.change.status', [$gift_voucher->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $gift_voucher->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $gift_vouchers])
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