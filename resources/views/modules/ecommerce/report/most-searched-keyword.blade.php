@extends('layouts.app')

@section('title', 'Most Searched Keywords Report')

@section('content')

<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.report_filter')
            <div class="card m-b-15">
                <div class="card-header">
                    <h5 class="no-margin">Top Most Searched Keywords Report ({{ $data->total() }})
                        <a href="{{ route('report.export.csv.most-searched-keyword') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                            <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="27">#</th>
                                <th width="50">Keywords</th>
                                <th width="50">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data != null)
                            @php $i = ($data->currentPage() - 1) * $data->perPage(); @endphp
                            @foreach($data as $key => $row)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $key }}</td>
                                <td>{{ $row }}</td>
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