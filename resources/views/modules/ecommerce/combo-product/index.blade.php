@extends('layouts.app')

@section('title', 'Combo Product')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            Combo Products ({{ $products->total() }})
                            <a href="{{ route('combo.product.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">Combo Product</span>
                            </a>
                            <a href="{{ route('combo.product.export.csv') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
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
                                <th>URL / Alias</th>
                                <th>Assigned Product</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="product">
                            @if ($products->count() > 0)
                            @php $i = ($products->currentPage() - 1) * $products->perPage(); @endphp
                            @foreach ($products as $product)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->alias != null ? $url. $product->alias->alias : 'N/A' }}</td>
                                <td>
                                    <ul>
                                        @foreach($product->product_combo as $row)
                                            <li>{{ $row->product->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if($product->product_categories != null)
                                        @foreach($product->product_categories as $row)
                                            {{ $row->category->name }} |
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $product->brand->name }}</td>
                                <td class="change-status">
                                    @if ($product->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $product->user->name }}</td>
                                <td>{{ $product->updated_at }}</td>
                                <td>
                                    <a href="{{ route('combo.product.edit', [$product->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-quick-edit-form" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-warning m-b-5 btn-quick-edit" data-uuid="{{ $product->uuid }}">
                                        <i class="pg-icon m-r-5">table_add</i> PRICE/QTY EDIT
                                    </a>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete btn-change-status" data-url="{{ route('combo.product.change.status', [$product->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $product->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $products])
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
<script>
    var url_product_get_detail = "{{ route('combo.product.get.details') }}"
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/product-quick-edit.min.js') }}" type="text/javascript"></script>
@endpush