@extends('layouts.app')
@section('title', 'List Group')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            List Group ({{ $list_groups->count() }})
                            <a href="{{ route('list.group.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">List Group</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>List Group</th>
                                <th>Slug</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($list_groups->count() > 0)
                                @php $i = 0; @endphp
                                @foreach ($list_groups as $list)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->slug }}</td>
                                    <td>{{ $list->user->name }}</td>
                                    <td>{{ $list->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('list.group.edit', [$list->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 text-success m-b-5">
                                            <i class="pg-icon m-r-5">pencil</i> EDIT
                                        </a>

                                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger btn-delete m-b-5" data-form="{{$i}}" type="button">
                                            <i class="pg-icon m-r-5">close_lg</i> DELETE
                                        </button>
                                        <form class="delete-form-{{$i}}" action="{{ route('list.group.destroy', [$list->uuid]) }}" method="POST" style="display: none;"> @method('DELETE') @csrf </form>
                                        
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