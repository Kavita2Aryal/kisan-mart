@extends('layouts.app')
@section('title', 'Quick Links')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Quick Links ({{ $links->total() }})
                            <a href="{{ route('quick.link.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">QUICK LINK</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dropdown dropdown-default pull-right m-b-10">
                        <button class="btn btn-link btn-link-fix text-primary p-l-10 p-r-25 dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="pg-icon m-r-5">stepper</i> SORT QUICK LINK
                        </button>
                        <div class="dropdown-menu">
                            @forelse($groups as $key => $grp)
                            <a class="dropdown-item" href="{{ route('quick.link.sort', [$key]) }}">{{ $grp }}</a>
                            @empty
                            <a class="dropdown-item" href="{{ route('quick.link.sort', [0]) }}">Quick Links</a>
                            @endforelse
                        </div>
                    </div>
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Quick Link">
                            @if ($links->count() > 0)
                            @php $i = ($links->currentPage() - 1) * $links->perPage(); @endphp
                            @foreach ($links as $link)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $link->title }}</td>
                                <td>{{ $link->link }}</td>
                                <td>{{ $groups[$link->group_id] }}</td>
                                <td class="change-status">
                                    @if ($link->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $link->user->name }}</td>
                                <td>{{ $link->updated_at }}</td>
                                <td>
                                    <a href="{{ route('quick.link.edit', [$link->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger btn-delete m-b-5" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">close_lg</i> DELETE
                                    </button>
                                    <form class="delete-form-{{$i}}" action="{{ route('quick.link.destroy', [$link->uuid]) }}" method="POST" style="display: none;"> @method('DELETE') @csrf </form>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('quick.link.change.status', [$link->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $link->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
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
            @include('includes.pagination', ['page' => $links])
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