@extends('layouts.app')

@section('title', 'Product Brand Report')

@section('content')

<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.report_filter')
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">Product Brand Report ({{ count($data) }})
                        <a href="{{ route('report.export.csv.product-brand') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                            <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Brand Name</th>
                                <th>Sold Quantity</th>
                                <th>Total Sales (NPR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data != null)
                            @php $i = ($data->currentPage() - 1) * $data->perPage(); @endphp
                            @foreach($data as $row)
                            <tr>
                                <td width="27">{{ ++$i }}</td>
                                <td width="50">{{ $row['name'] }}</td>
                                <td width="50">{{ $row['qty'] }}</td>
                                <td width="50">{{ number_format($row['price'], 2) }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $data->links() }}
        </div>
    </div>
</div>

@endsection

@push('styles')

<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endpush

@push('scripts')

<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script>
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
    $(document).on('change', '.end-date', function() {
        $('.form-filter').submit();
    });
</script>
@endpush