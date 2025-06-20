@extends('layouts.app')
@section('title', 'Social Media')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Social Media ({{ $social_medias->count() }})
                            <a href="{{ route('social.media.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">SOCIAL MEDIA</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('social.media.sort') }}" class="btn btn-link btn-link-fix text-primary p-l-10 p-r-10 m-b-10 pull-right">
                        <i class="pg-icon m-r-5">stepper</i> SORT SOCIAL <span class="visible-x-inline m-l-5">MEDIA</span>
                    </a>
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Social Media</th>
                                <th>Profile Link</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Social Media">
                            @if ($social_medias->count() > 0)
                            @php $i = ($social_medias->currentPage() - 1) * $social_medias->perPage(); @endphp
                            @foreach ($social_medias as $social)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ ucwords($social->social) }}</td>
                                <td>{{ $social->link }}</td>
                                <td class="change-status">
                                    @if ($social->is_active == 10)
                                    <strong class="text-success">PUBLISHED<strong>
                                            @else
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    @endif
                                </td>
                                <td>{{ $social->user->name }}</td>
                                <td>{{ $social->updated_at }}</td>
                                <td>
                                    <a href="{{ route('social.media.edit', [$social->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger m-b-5 btn-delete" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">close_lg</i> DELETE
                                    </button>
                                    <form class="delete-form-{{$i}}" action="{{ route('social.media.destroy', [$social->uuid]) }}" method="POST" style="display: none;"> @method('DELETE') @csrf </form>

                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('social.media.change.status', [$social->uuid]) }}" type="button">
                                        <i class="pg-icon m-r-5">tick</i>
                                        <span>{{ $social->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                    </button>
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
            @include('includes.pagination', ['page' => $social_medias])
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