@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Users ({{ $users->total() }})
                            @can('user.create')
                            <a href="{{ route('user.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> Add <span class="visible-x-inline m-l-5">User</span>
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="User">
                            @if ($users->count() > 0)
                            @php $i = ($users->currentPage() - 1) * $users->perPage(); @endphp
                            @foreach ($users as $user)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><strong class="text-uppercase">{{ $user->role->role }}</strong></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info btn-view-permission" type="button" data-permission="{{ route('user.view.permission', [$user->uuid]) }}">Permissions</button>
                                </td>
                                <td class="change-status">
                                    @if ($user->is_active == 10)
                                    <strong class="text-success">ACTIVE<strong>
                                            @else
                                            <strong class="text-danger">INACTIVE<strong>
                                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @can('user.update')
                                    <a href="{{ route('user.edit', [$user->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success"><i class="pg-icon m-r-5">pencil</i> EDIT</a>
                                    @if (auth()->user()->id != $user->id)
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger btn-change-status" data-url="{{ route('user.change.status', [$user->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $user->is_active == 10 ? 'DEACTIVATE' : 'ACTIVATE' }}</span>
                                    </button>
                                    @endif
                                    @endcan
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
            @include('includes.pagination', ['page' => $users])
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll modal-permission" data-backdrop="static">
    <div class="modal-dialog" style="min-width: 300px; width: auto; max-width: 600px;">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button aria-label="" type="button" class="close" data-dismiss="modal"><i class="pg-icon">close</i></button>
                    <h5>User Permissions</h5>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/user.min.js') }}"></script>
@endpush