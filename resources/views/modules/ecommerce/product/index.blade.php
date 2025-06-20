@extends('layouts.app')

@section('title', 'Product')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">

            @include('includes.pagination_search')

            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="no-margin">
                            Products ({{ $products->total() }})
                            <a href="{{ route('product.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">Product</span>
                            </a>
                            <a href="{{ route('product.import') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
                                <i class="pg-icon m-r-5">upload</i> Import <span class="visible-x-inline m-l-5">Product</span>
                            </a>
                            <a href="{{ route('product.export.csv') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body" style="overflow-x: scroll;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20">#</th>
                                <th width="100">Name</th>
                                <th width="150">URL / Alias</th>
                                <th width="150">Category</th>
                                <th width="100">Brand</th>
                                <th width="50">Status</th>
                                <th width="50">Created By</th>
                                <th width="50">Last Updated At</th>
                                <th width="50">Option</th>
                                <th width="175">Image Link</th>
                            </tr>
                        </thead>
                        <tbody data-title="product" style="word-break: break-all;">
                            @if ($products->count() > 0)
                            @php $i = ($products->currentPage() - 1) * $products->perPage(); @endphp
                            @foreach ($products as $product)
                            @php $i++; @endphp
                            <tr>
                                <td width="20">{{ $i }}</td>
                                <td width="150">{{ ucwords($product->name) }}</td>
                                <td width="150">{{ $product->alias != null ? $url. $product->alias->alias : 'N/A' }}</td>
                                <td width="100">
                                    @if($product->product_categories != null)
                                        @foreach($product->product_categories as $row)
                                            {{ $row->category->name }}, </br>
                                        @endforeach
                                    @endif
                                </td>
                                <td width="50">{{ $product->brand->name }}</td>
                                <td width="50" class="change-status">
                                    @if ($product->out_of_stock == 10)
                                    <strong class="text-success">OUT OF STOCK<strong>
                                            @else
                                            <strong class="text-danger">IN STOCK<strong>
                                                    @endif
                                </td>
                                <td width="50" class="change-status">
                                    @if ($product->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td width="50">{{ $product->user->name }}</td>
                                <td width="50">{{ $product->updated_at }}</td>
                                <td width="50">
                                    <a href="{{ route('product.edit', [$product->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-quick-edit-form" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-warning m-b-5 btn-quick-edit" data-uuid="{{ $product->uuid }}">
                                        <i class="pg-icon m-r-5">table_add</i> PRICE/QTY EDIT
                                    </a>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete btn-change-stock-status" data-url="{{ route('product.change.stock.status', [$product->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $product->out_of_stock == 10 ? 'IN STOCK' : 'OUT OF STOCK' }}</span>
                                    </button>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete btn-change-status" data-url="{{ route('product.change.status', [$product->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $product->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                </td>
                                <td width="175">{!! $product->image_link !!}</td>
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
    var url_product_get_detail = "{{ route('product.get.details') }}"
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/product-quick-edit.min.js') }}" type="text/javascript"></script>
@endpush