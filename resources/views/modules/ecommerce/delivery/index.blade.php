@extends('layouts.app')

@section('title', 'Delivery')

@section('content')
    <div class="container-fluid">
        <div class="row m-t-30">
            <div class="col-sm-12 col-md-12 col-lg-12">

                @include('includes.pagination_search')

                <div class="card m-b-15">
                    <div class="card-header">
                        <div class="card-title full-width">
                            <h5 class="no-margin">
                                Delivery ({{ $deliveries->total() }})
                                <a href="{{ route('delivery.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                    <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5"> DELIVERY </span>
                                </a>
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive-block">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Day</th>
                                <th>Delivery TYpe</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody data-title="delivery">
                            @if ($deliveries->count() > 0)
                                @php $i = ($deliveries->currentPage() - 1) * $deliveries->perPage(); @endphp
                                @foreach ($deliveries as $delivery)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $delivery->name }}</td>
                                        <td>{{ $delivery->day }}</td>
                                        <td>{{ $delivery->delivery_type == 1 ? "Free Delivery" : "Discount On Delivery"}}</td>
                                        <td class="change-status">
                                            @if ($delivery->is_active == 10)
                                                <strong class="text-success">PUBLISHED<strong>
                                                        @else
                                                            <strong class="text-danger">UNPUBLISHED<strong>
                                            @endif
                                        </td>
                                        <td>{{ $delivery->user->name }}</td>
                                        <td>
                                            <a href="{{ route('delivery.edit', [$delivery->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                                <i class="pg-icon m-r-5">pencil</i> EDIT
                                            </a>
                                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('delivery.change.status', [$delivery->uuid]) }}" type="button">
                                                <i class="pg-icon m-r-5">tick</i>
                                                <span>{{ $delivery->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
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
                @include('includes.pagination', ['page' => $deliveries])
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
