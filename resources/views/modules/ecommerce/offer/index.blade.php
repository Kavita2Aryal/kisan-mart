@extends('layouts.app')

@section('title', 'Offer')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            Offers ({{ $offers->total() }})
                            <a href="{{ route('offer.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">offer</span>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name / Title</th>
                                <!-- <th>URL / Alias</th> -->
                                <th>Offer Date</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="offer">
                            @if ($offers->count() > 0)
                            @php $i = ($offers->currentPage() - 1) * $offers->perPage(); @endphp
                            @foreach ($offers as $offer)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $offer->name }}<br />{{ $offer->title }}</td>
                                <!-- <td>{{ $url.$offer->alias->alias }}</td> -->
                                <td>
                                    @if ($offer->start_date)<strong class="text-info">{{ $offer->start_date }}</strong>@endif
                                    @if ($offer->end_date)<strong> - </strong><strong class="text-info">{{ $offer->end_date }}</strong>@endif
                                </td>
                                <td class="change-status">
                                    @if ($offer->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $offer->user->name }}</td>
                                <td>{{ $offer->updated_at }}</td>
                                <td>
                                    <a href="{{ route('offer.edit', [$offer->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('offer.change.status', [$offer->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $offer->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                    <a href="{{ route('offer.manage', [$offer->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary m-b-5">
                                        <i class="pg-icon m-r-5">menu_add</i> MANAGE
                                    </a>
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
            @include('includes.pagination', ['page' => $offers])
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