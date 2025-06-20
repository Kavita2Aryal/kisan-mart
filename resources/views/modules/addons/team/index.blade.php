@extends('layouts.app')
@section('title', 'Team Members')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Team Members ({{ $teams->total() }})
                            <a href="{{ route('team.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> Add <span class="visible-x-inline m-l-5">Team Member</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dropdown dropdown-default pull-right m-b-10">
                        <button class="btn btn-link btn-link-fix text-primary p-l-10 p-r-25 dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="pg-icon m-r-5">stepper</i> SORT TEAM <span class="visible-x-inline m-l-5">MEMBER</span>
                        </button>
                        <div class="dropdown-menu">
                            @forelse($groups as $key => $grp)
                            <a class="dropdown-item" href="{{ route('team.sort', [$key]) }}">{{ $grp }}</a>
                            @empty
                            <a class="dropdown-item" href="{{ route('team.sort', [0]) }}">Team Member</a>
                            @endforelse
                        </div>
                    </div>
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Image</th>
                                <th>Team Member</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Team">
                            @if ($teams->count() > 0)
                            @php $i = ($teams->currentPage() - 1) * $teams->perPage(); @endphp
                            @foreach ($teams as $team)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    @if (isset($team->image_id) && $team->image_id > 0 && isset($team->image->image))
                                    <a href="{{ secure_img($team->image->image, '1200') }}" target="_blank">
                                        <img src="{{ secure_img($team->image->image, '480X320') }}" width="100">
                                    </a>
                                    @endif
                                </td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $groups[$team->group_id] }}</td>
                                <td class="change-status">
                                    @if ($team->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $team->user->name }}</td>
                                <td>{{ $team->updated_at }}</td>
                                <td>
                                    <a href="{{ route('team.edit', [$team->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger m-b-5 btn-delete" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">close_lg</i> DELETE
                                    </button>
                                    <form class="delete-form-{{$i}}" action="{{ route('team.destroy', [$team->uuid]) }}" method="POST" style="display: none;"> @method('DELETE') @csrf </form>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('team.change.status', [$team->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $team->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
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
            @include('includes.pagination', ['page' => $teams])
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