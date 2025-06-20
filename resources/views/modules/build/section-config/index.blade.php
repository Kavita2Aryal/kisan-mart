@extends('layouts.app')
@section('title', 'Section Config')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-lg-8">
            @include('includes.pagination_search')
            <div class="card">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Section Configurations ({{ $sections->data->count() }})
                            <a href="{{ route('section.config.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">add</i> ADD SECTION CONFIG
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-b-0">
                    @if ($sections->data->count() > 0)
                    <div class="row">
                        @foreach ($sections->data as $section)
                        <div class="col-lg-6 col-xl-4">
                            <div class="section-item card social-card share full-width cursor" data-url="{{ route('section.config.get.section', [$section['uuid']]) }}">
                                <div class="card-content">
                                    <img alt="Section {{ $section['index'] }}" src="{{ url('storage/cms/section/'.$section['filename']) }}">
                                </div>
                                <div class="card-header clearfix last">
                                    <div class="thumbnail-wrapper d32 circular">
                                        <span class="icon-thumbnail bg-complete-light pull-left hint-text pg-icon">pencil</span>
                                    </div>
                                    <div class="inline m-l-15">
                                        <h5>Section {{ $section['index'] }}</h5>
                                        <h6>{{ date('Y-m-d', strtotime($section['updated_at'])) }}, {{ $section['user'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <h5>No data to display.</h5>
                    @endif
                </div>
            </div>
            @include('includes.pagination', ['page' => $sections->paging])
        </div>
        <div class="col-lg-4 update-section-container parent-section"></div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
@include('modules.build.section-config.script')
<script>
    var dropzone_init = function(filename, size) {
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone-section-config", {
            url: upload_url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            thumbnailWidth: 240,
            thumbnailHeight: 240,
            addRemoveLinks: true,
            paramName: "image",
            acceptedFiles: "image/*,pdf",
            maxFilesize: 2,
            maxFiles: 6,
            uploadMultiple: false,
            autoProcessQueue: true,
            parallelUploads: 1,
            init: function() {
                this.on("success", function(file, response) {
                    if (response.status == 'success') {
                        $('.section-config-temp').append('<input type="hidden" data-image="' + file.name + '" value="' + response.filename + '"/>');
                        $('.section-filename').val(response.filename);
                        $('.section-image').attr('src', image_url + response.filename);
                        notify_bar('success', 'One Image Uploaded');
                    } else {
                        notify_bar('danger', 'Something went wrong');
                        myDropzone.removeFile(file);
                    }
                });
            }
        });

        var mockFile = {
            name: filename,
            size: size
        };
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, image_url + filename);
        myDropzone.emit("complete", mockFile);
    }
</script>
@endpush