@extends('layouts.app')

@section('title', 'Upload Image')

@section('content')
@php
$min_width = config('app.config.image_min_width');
$min_height = config('app.config.image_min_height');
@endphp
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title full-width">Upload Image
                        <a href="{{ route('media.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                    </div>
                </div>
                <div class="card-body no-scroll no-padding">
                    <form action="#" class="dropzone dropzone-media no-margin" method="post" enctype="multipart/form-data">
                        <div class="fallback">
                            <input name="image" type="file" accept="image/*">
                        </div>
                    </form>
                    <div class="media-temp"></div>
                </div>
                <div class="card-header">
                    <div class="card-title full-width">
                        Minimun Resolution: {{ $min_width }}px X {{ $min_height }}px
                        <a href="javascript:location.reload();" class="normal btn btn-link pull-right" data-tippy-content="Refresh" data-tippy-placement="left"><i class="pg-icon">refresh_alt</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script>
var min_width = "{{ $min_width }}";
var min_height = "{{ $min_height }}";
var upload_url = "{{ route('media.upload.image') }}";
var remove_url = "{{ route('media.remove.image') }}";
</script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/media.upload.min.js') }}" type="text/javascript"></script>
@endpush
