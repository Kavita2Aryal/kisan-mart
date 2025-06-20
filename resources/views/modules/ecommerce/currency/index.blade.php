@extends('layouts.app')

@section('title', 'Currency')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            Currencies ({{ $currencies->total() }})
                            <a href="{{ route('currency.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">CURRENCY</span>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Currency</th>
                                <th>Exchange Rate</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="country">
                            @if ($currencies->count() > 0)
                            @php $i = ($currencies->currentPage() - 1) * $currencies->perPage(); @endphp
                            @foreach ($currencies as $currency)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $currency->currency }}</td>
                                <td>{{ $currency->exchangeRate->rate ?? 'N/A' }}</td>
                                <td class="change-status">
                                    @if ($currency->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $currency->user->name }}</td>
                                <td>{{ $currency->updated_at }}</td>
                                <td>
                                    @if($currency->currency != 'NPR')
                                    <a href="{{ route('currency.edit', [$currency->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('currency.change.status', [$currency->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $currency->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                    <a href="{{ route('currency.exchange.rate.edit', [$currency->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary m-b-5">
                                        <i class="pg-icon m-r-5">menu_add</i> EXCHANGE RATE
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $currencies])
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