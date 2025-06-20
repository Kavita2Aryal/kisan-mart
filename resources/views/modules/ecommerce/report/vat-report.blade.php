@extends('layouts.app')

@section('title', 'Vat Amount Report')

@section('content')

<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.report_filter')
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">VAT Amount Report ({{ $data->total() }})
                        <a href="{{ route('report.export.csv.vat') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                            <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="50">Date</th>
                                <th width="50">Vat Amount (NPR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->count() > 0)
                            @foreach($data as $key => $row)
                            <tr>
                                <td width="50">{{ date('Y-m-d', strtotime($key)) }}</td>
                                <td width="50">{{ number_format($row['v_total'], 2) }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            @php
                            $total_vat_amount = 0;
                            @endphp
                            @foreach($all as $r_row)
                            @php
                            $total_vat_amount += $r_row['v_total'];
                            @endphp
                            @endforeach
                            <tr>
                                <th width="50">GRAND TOTAL ({{ $data->total() }}) </th>
                                <th width="50">NPR {{ number_format($total_vat_amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            {{ $data->links() }}
        </div>
    </div>
</div>
<!-- working body container -->
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