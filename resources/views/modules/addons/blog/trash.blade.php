@extends('layouts.app')
@section('title', 'Blogs')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Trashed Blogs ({{ $blogs->total() }})
                            <div class="pull-right">
                                <a href="{{ route('blog.index') }}" class="normal btn btn-link m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Title</th>
                                <th>URL / Alias</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Published Date</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="blog">
                            @if ($blogs->count() > 0)
                            @php $i = ($blogs->currentPage() - 1) * $blogs->perPage(); @endphp
                            @foreach ($blogs as $blog)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $website_domain . $blog->alias->alias}}</td>
                                <td>{{ $blog->category->name }}</td>
                                <td>{{ $blog->author_id != null ? $blog->author->name : 'N/A' }}</td>
                                <td>{{ $blog->published_at }}</td>
                                <td class="change-status">
                                    @if ($blog->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $blog->user->name }}</td>
                                <td>{{ $blog->updated_at }}</td>
                                <td>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5 btn-restore" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">refresh</i> RESTORE
                                    </button>
                                    <form class="restore-form-{{$i}}" action="{{ route('blog.restore', [$blog->uuid]) }}" method="POST" style="display: none;"> @method('PUT') @csrf </form>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger btn-delete m-b-5" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">close_lg</i> DELETE
                                    </button>
                                    <form class="delete-form-{{$i}}" action="{{ route('blog.destroy', [$blog->uuid]) }}" method="POST" style="display: none;"> @method('DELETE') @csrf </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $blogs])
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