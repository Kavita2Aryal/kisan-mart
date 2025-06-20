@extends('layouts.app')

@section('title', 'Cart Report')

@section('content')
@php $domain = get_setting('website-domain');
@endphp

<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">Cart Report ({{ $carts->total() }})
                        <a href="{{ route('report.export.csv.cart') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                            <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block dataTable with-export custom-table">
                        <thead>
                            <tr>
                                <th width="27">#</th>
                                <th width="50">Product / Gift Voucher</th>
                                <th width="50">Alias</th>
                                <th width="50">Qty</th>
                                <th width="50">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($carts->count() > 0)
                            @php $i = ($carts->currentPage() - 1) * $carts->perPage(); @endphp
                            @foreach ($carts as $row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $row->product_name }}</td>
                                <td>{{ $domain . $row->product_alias }}</td>
                                <td>{{ $row->count }}</td>
                                <td> <a href="javascript:void(0);" data-index="{{ $row->product_uuid }}" data-product="{{ $row->product_name }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary m-b-5 view-cart-customer" data-toggle="modal" data-target="#cart-customer-modal">
                                        <i class="pg-icon m-r-5">eye</i> VIEW CUSTOMER
                                    </a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $carts])
        </div>
    </div>
    <div class="modal" id="cart-customer-modal" data-backdrop="static" style="padding: 0 !important;">
    </div>
</div>

@endsection

@push('styles')
@endpush

@push('scripts')
<script>
    $(document).on('click', '.view-cart-customer', function(e) {
        e.preventDefault();
        var index = $(this).data('index');
        var product_name = $(this).data('product');
        $.ajax({
            url: "{{ route('report.cart.customer') }}",
            type: 'GET',
            data: {
                index: index
            },
            async: false,
            success: function(response) {
                if (response.status) {
                    var $content = response.html;
                    var $modal = $('#cart-customer-modal');
                    $modal.html($content);
                    $modal.find('.product-name-show').html('<strong>' + product_name + '</strong>');
                }
            }
        });
    });
</script>
@endpush