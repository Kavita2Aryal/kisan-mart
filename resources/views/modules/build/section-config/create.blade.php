@extends('layouts.app')
@section('title', 'Create Section Config')

@section('content')
<div class="container-fluid section-config-management">
    <form action="{{ route('section.config.store') }}" method="post" class="section-config-form">   
        @csrf
        <div class="row m-t-30">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Upload Section Image
                            <button type="submit" class="btn btn-link btn-link-fix p-r-10 p-l-10 btn-save m-l-5 pull-right">SAVE</button>
                            <a href="{{ route('section.config.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body no-scroll no-padding">
                        <div class="dropzone dropzone-section-config no-margin" style="min-height: 250px;">
                            <div class="fallback">
                                <input name="image" type="file" accept="image/*">
                            </div>
                        </div>
                        <div class="section-config-temp"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-t-10 m-b-20 parent-container"></div>
        <div class="clearfix"></div>
    </form>
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
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone(".dropzone-section-config", { 
    url: upload_url,
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    thumbnailWidth: 240,
    thumbnailHeight: 240,
    addRemoveLinks: true,
    paramName: "image", 
    acceptedFiles: "image/*,pdf",
    maxFilesize: 2,
    maxFiles : 3,
    uploadMultiple: false,
    autoProcessQueue: true,
    parallelUploads: 1,
    init: function () {
        this.on("success", function (file, response) {
            if (response.status == 'success') {
                $('.section-config-temp').append('<input type="hidden" data-image="'+file.name+'" value="'+response.filename+'"/>'); 
                $('.parent-container').append(response.html);
                notify_bar('success', 'One Image Uploaded');
            }
            else {
                myDropzone.removeFile(file);
                notify_bar('danger', 'Something went wrong');
            }
        });
        this.on("removedfile", function(file) {
            $.ajax({
                url: remove_url,
                type: "post",
                data: { image: $('[data-image="'+file.name+'"]').val()},
                async: false,
                success: function (response) {
                    $('[data-image="'+file.name+'"]').remove();
                    if (response.status == 'failed') {
                        notify_bar('danger', 'Something went wrong');
                    }
                }
            });           
        });
    }
});
</script>
@endpush