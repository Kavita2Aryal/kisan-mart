@extends('layouts.app')
@section('title', 'Access Roles')

@section('content')
<div class="container-fluid">
    <div class="row m-t-20">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Access Roles
                            <a href="{{ route('role.create') }}" class="normal btn btn-link btn-link-fix p-l-10 p-r-10 pull-right">
                                <i class="pg-icon m-r-5">plus</i> Add <span class="visible-x-inline m-l-5">Access Role</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="permission-masonry">
                        @forelse ($roles as $role)
                        <div class="permission-masonry-item">
                            <div class="card m-b-0">
                                <div class="card-header">
                                    <div class="card-title full-width">
                                        <strong class="{{ $role->is_active == 10 ? 'text-success' : 'text-danger' }}">{{ $role->role }}</strong>
                                        @if ($role->is_super == 0)
                                        <a href="{{ route('role.edit', [$role->uuid]) }}" class="normal btn btn-link pull-right" data-tippy-content="Edit Role" data-tippy-placement="left"><i class="pg-icon">pencil</i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    @php $permissions = $role->permissions(); @endphp
                                    @if ($permissions == '*')
                                        <span class="label label-warning">Master permission of all modules</span>
                                    @else
                                        @foreach ($permissions as $permission)
                                        <span class="label label-warning inline m-b-5">{{ $permission }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <h5>No data to display</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection