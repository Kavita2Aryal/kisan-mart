@extends('layouts.app')
@section('title', 'Pages')

@section('content')
@php
$website_domain = get_setting('website-domain');
$add_page = config('app.config.cms_page_add') == 'YES' ? true : false;
$mini_page = config('app.config.cms_page_type') == 'MINI' ? true : false;
@endphp
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Pages ({{ $pages->total() }})
                            @can('page.create')
                            @if ($add_page)
                            @if ($mini_page)
                            <a href="{{ route('page.mini.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">PAGE</span>
                            </a>
                            @else
                            <a href="{{ route('page.layout.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">PAGE</span>
                            </a>
                            @endif
                            @endif
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Page</th>
                                <th>URL / Alias</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Page">
                            @if ($pages->count() > 0)
                            @php $i = ($pages->currentPage() - 1) * $pages->perPage(); @endphp
                            @foreach ($pages as $pg)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>@if ($pg->is_home == 10) <i class="pg-icon m-r-5">home</i> @endif {{ $pg->name }}</td>
                                <td>
                                    <a href="{{ ($pg->is_home == 10) ? $website_domain : $website_domain . $pg->alias->alias }}" target="_blank">{{ ($pg->is_home == 10) ? $website_domain : $website_domain . $pg->alias->alias }}</a>
                                </td>
                                <td class="change-status">
                                    @if ($pg->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $pg->user->name }}</td>
                                <td>{{ $pg->updated_at }}</td>
                                <td>
                                    @can('page.update')
                                    <a href="{{ route('page.edit', [$pg->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    @if (!$mini_page)
                                    <a href="{{ route('page.layout.edit', [$pg->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT LAYOUT
                                    </a>
                                    @endif
                                    @if ($pg->is_home == 0)
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete btn-change-status" data-url="{{ route('page.change.status', [$pg->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i><span>{{ $pg->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-info btn-change-home" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">home</i><span>MARK HOME</span>
                                    </button>
                                    <form class="home-form-{{$i}}" action="{{ route('page.change.home', [$pg->uuid]) }}" method="POST" style="display: none;"> @method('PUT') @csrf </form>
                                    @endif
                                    @endcan

                                    @can('page.delete')
                                    @if ($pg->is_home == 0)
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger btn-delete" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">close_lg</i> DELETE
                                    </button>
                                    <form class="delete-form-{{$i}}" action="{{ route('page.destroy', [$pg->uuid]) }}" method="POST" style="display: none;"> @method('DELETE') @csrf </form>
                                    @endif
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $pages])
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