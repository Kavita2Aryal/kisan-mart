@extends('layouts.app')

@section('title', 'PromoCode')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            PromoCodes ({{ $promocodes->total() }})
                            <a href="{{ route('promocode.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">PromoCode</span>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Promo Code</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="promocode">
                            @if ($promocodes->count() > 0)
                            @php $i = ($promocodes->currentPage() - 1) * $promocodes->perPage(); @endphp
                            @foreach ($promocodes as $promocode)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $promocode->code }}</td>
                                <td>
                                    @if($promocode->type == 1)
                                    <strong>Applied To All</strong>
                                    @elseif($promocode->type == 2)
                                    <strong>Applied To Included Products</strong>
                                    @else
                                    <strong>Applied To Excluded Products</strong>
                                    @endif
                                </td>
                                <td><strong class="text-success">{{ $promocode->start_date }}</strong>
                                    <strong> - </strong>
                                    @if ($promocode->end_date)<strong class="text-danger">{{ $promocode->end_date }}</strong>@endif
                                </td>
                                <td class="change-status">
                                    @if ($promocode->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $promocode->user->name }}</td>
                                <td>{{ $promocode->updated_at }}</td>
                                <td>
                                    <a href="{{ route('promocode.edit', [$promocode->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('promocode.change.status', [$promocode->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $promocode->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                    @if($promocode->type != 1)
                                    <a href="{{ route('promocode.manage', [$promocode->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary">
                                        <i class="pg-icon m-r-5">menu_add</i> MANAGE
                                    </a>
                                    @endif
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
            @include('includes.pagination', ['page' => $promocodes])
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