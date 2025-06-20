@extends('layouts.app')

@section('title', 'Product Reviews')

@section('content')

<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            Product Review ({{ $product_reviews->total() }})
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Order</th>
                                <th>Title</th>
                                <th>Product</th>
                                <th>Spam Count</th>
                                <th>Status</th>
                                <th>Last Updated Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody data-title="Product Review">
                            @if ($product_reviews->count() > 0)
                            @php $i = ($product_reviews->currentPage() - 1) * $product_reviews->perPage(); $url = config('app.config.website'); @endphp
                            @forelse($product_reviews as $row)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row->order->order_code }}</td>
                                <td>{{ $row->title }}</td>
                                <td><a href="{{ $url . $row->product->alias->alias }}">{{ ucwords($row->product->name) }}</a></td>
                                <td>{{ $row->spam_count }}</td>
                                <td class="change-status">
                                    @if ($row->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $row->updated_at }}</td>
                                <td>
                                    <a href="{{ route('product.review.show', [$row->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5"><i class="pg-icon m-r-5">eye</i>View</a>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete btn-change-status" data-url="{{ route('product.review.change.status', [$row->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $row->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                    @if($row->temp_comment != null)
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete btn-change-update" data-url="{{ route('product.review.update', [$row->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>PUBLISH UPDATED</span>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No data to display</td>
                            </tr>
                            @endforelse
                            @else
                            <tr>
                                <td colspan="10">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $product_reviews])
        </div>
    </div>
</div>
<div class="modal" id="modal-quick-edit-form" tabindex="-1" role="dialog" data-backdrop="static">

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>
@endpush