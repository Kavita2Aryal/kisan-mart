@extends('layouts.app')

@section('title', 'Product View Report')

@section('content')
@php $domain = rtrim(get_setting('website-domain'), '/'); @endphp
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.product_view_report_filter')
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">Product View Report({{ $data['totalResults'] }})
                        <a href="{{ route('report.export.csv.product-view') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                            <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block dataTable with-export custom-table">
                        <thead>
                            <tr>
                                <th width="27">#</th>
                                <th width="50">Product Name</th>
                                <th width="50">URL</th>
                                <th width="50">View Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data != null)
                            @php $i = 0; @endphp
                            @foreach($data as $key => $row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $row[1] }}</td>
                                <td>{{ $domain.$row[0] }}</td>
                                <td>{{ $row[2] }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @includeWhen(($data['totalResults'] > $data['itemsPerPage']),
            'includes.pagination_product_view',
            ['data' => $data, 'page' => $current_page, 'url' => $url, 'total_pages' => number_format(ceil($data['totalResults'] / $data['itemsPerPage']))]
            )
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
        format: 'yyyy-mm-dd',
    });
    $('.start-date').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '+0d'
    });
    $('.end-date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: $('.start-date').val(),
        endDate: '+0d'
    });

    $(document).on('change', '.end-date', function() {
        $('.form-filter').submit();
    });
    $(document).on('change', '.page-limit', function() {
        $('.form-filter').submit();
    });
</script>
@endpush