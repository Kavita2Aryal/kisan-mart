@extends('layouts.app')
@section('title', 'Activity Logs')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            <form class="filter-log" action="{{ route('log.activity') }}" method="GET">
                <input type="hidden" name="page" class="hidden-page">
                <div class="card m-b-15">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group input-group transparent">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent text-info">Activity Log: Month</span>
                                    </div>
                                    <select class="form-control" name="selected_file" data-tippy-content="Choose a month" data-tippy-placement="top">
                                        @forelse($files as $file)
                                        <option value="{{ substr($file, 5) }}" {{ (isset($_GET['selected_file']) && substr($file, 5) == $_GET['selected_file']) ? 'selected' : '' }}>{{ substr($file, 5, 7) }}</option>
                                        @empty
                                        <option value="">No logs available</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-link btn-link-fix p-l-20 p-r-20 btn-lg m-r-5">FILTER</button>
                                <a href="{{ route('log.activity') }}" class="btn btn-link btn-link-fix p-l-20 p-r-20 text-danger btn-lg">CLEAR</a>
                            </div>
                        </div>
                        <table class="table table-hover table-condensed table-condensed">
                            <tbody>
                                <tr style="background: #ececec;">
                                    <th>
                                        <div class="form-group form-group-default m-b-0">
                                            <label>Activity</label>
                                            <input type="search" name="search_activity" class="form-control" placeholder="Search by keyword" value="{{ $_GET['search_activity'] ?? '' }}">
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group form-group-default input-group m-b-0">
                                            <div class="form-input-group">
                                                <label>Creator</label>
                                                <select name="search_user" class="form-control">
                                                    <option value="">All</option>
                                                    @foreach($users as $id => $user)
                                                    <option value="{{ $id }}" {{ (isset($_GET['search_user']) && $_GET['search_user'] == $id) ? 'selected' : '' }}>{{ strtoupper($user) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group form-group-default m-b-0">
                                            <label>Activity Date</label>
                                            <input type="date" min="{{ $start_date }}" max="{{ $end_date }}" name="search_date" class="form-control" placeholder="Date Time" value="{{ $_GET['search_date'] ?? '' }}">
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group form-group-default input-group m-b-0">
                                            <div class="form-input-group">
                                                <label>Activity Type</label>
                                                <select name="search_type" class="form-control">
                                                    <option value="">All</option>
                                                    @if ($types)
                                                        @foreach($types as $type)
                                                        <option value="{{ $type }}" {{ (isset($_GET['search_type']) && $_GET['search_type'] == $type) ? 'selected' : '' }}>{{ strtoupper($type) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                @if ($logs)
                                    @foreach($logs as $key => $log)
                                    <tr>
                                        <td>{{ $log[2] }}</td>
                                        <td>{{ strtoupper($users[$log[3]] ?? 'System') }}</td>
                                        <td>{{ $log[0] }}</td>
                                        <td>{{ strtoupper($log[1]) }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No data to display</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($logs)
                <div class="m-t-20 m-b-20">
                    {{ $logs->links() }}
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document)
.on('click', '.page-link', function(e) { e.preventDefault();
    $('.hidden-page').val($(this).attr('href').split("=")[1]);
    $('.filter-log').submit();
});
</script>
@endpush