@extends('layouts.app')
@section('title', 'Media Gallery')

@section('content')
<div class="container-fluid">
    @include('modules.cms.media.includes.pagination_search')
    <div class="row">
        <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
            @if ($images->count() > 0)
            <div class="media-masonry">
                @foreach ($images as $row)
                @if (Storage::exists('public/media/' . $row->image))
                <div class="media-masonry-item media-parent media-{{ $row->id }}">
                    <div class="media-image">
                        <a href="{{ secure_img($row->image, '1200') }}" target="_blank">
                            <img src="{{ secure_img($row->image, '480X320') }}" class="full-width">
                        </a>
                    </div>
                    <div class="media-options">
                        <div class="pull-right">
                            <button type="button" class="btn btn-link crop-image">
                                <i class="pg-icon">crop</i>
                            </button>
                            <button type="button" class="btn btn-link edit-image">
                                <i class="pg-icon">pencil</i>
                            </button>
                            <button type="button" class="btn btn-link text-danger remove-image">
                                <i class="pg-icon">close_lg</i>
                            </button>
                            <input type="hidden" class="image-src" value="{{ $media_path }}">
                            <input type="hidden" class="image-index" value="{{ $row->id }}">
                            <input type="hidden" class="image-image" value="{{ $row->image }}">
                            <input type="hidden" class="image-title" value="{{ $row->title }}">
                            <input type="hidden" class="image-caption" value="{{ $row->caption }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @else
            <p>Image not found!</p>
            @endif
        </div>
    </div>
    @include('includes.pagination', ['page' => $images])
</div>

@include('modules.cms.media.includes.modal_crop')
@include('modules.cms.media.includes.modal_edit')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/cropper/cropper.min.css') }}">
@endpush

@push('scripts')
<script>
    var crop_url = "{{ route('media.crop.image') }}";
    var remove_url = "{{ route('media.remove.image') }}";
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/cropper/cropper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/media.manager.min.js') }}" type="text/javascript"></script>
@endpush