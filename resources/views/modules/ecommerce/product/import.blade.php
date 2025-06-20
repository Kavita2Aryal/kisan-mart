@extends('layouts.app')

@section('title', 'Import Product')

@section('content')

<div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
            <div class="card card-default m-t-10">

                <div class="card-header">
                    <div class="card-title full-width">
                        Import Product (Drag n' drop File Here <span style="color:tomato">*</span>)
                        <a href="{{ asset('/storage/product/excel/product-excel-upload-sample.xlsx') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-r-5 pull-right" download> <i class="pg-icon m-r-5">download</i> Download Sample</a>

                        <a href="{{ route('product.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                    </div>
                </div>
                <div class="card-body no-scroll no-padding">
                    <form action="#" class="dropzone no-margin" method="post" enctype="multipart/form-data">
                        <div class="fallback">
                            <input name="excel_file" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="spanner">
            <div class="loader"></div>
            <p>Uploading your file, please be patient.</p>
        </div>
    </div>
</div>
<!-- working body container -->
@endsection

@push('styles')

<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .spanner {
        position: absolute;
        top: 35%;
        height: 118vh;
        left: 0;
        background: #2a2a2a55;
        width: -webkit-fill-available;
        ;
        /* height: 100%; */
        display: block;
        text-align: center;
        /* height: 300px; */
        color: #FFF;
        transform: translateY(-50%);
        z-index: 1000;
        visibility: hidden;
    }

    .loader,
    .loader:before,
    .loader:after {
        border-radius: 50%;
        width: 2.5em;
        height: 2.5em;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation: load7 1.8s infinite ease-in-out;
        animation: load7 1.8s infinite ease-in-out;
    }

    .loader {
        color: #ffffff;
        font-size: 10px;
        margin: 80px auto;
        margin-top: 61vh;
        position: relative;
        text-indent: -9999em;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    .loader:before,
    .loader:after {
        content: '';
        position: absolute;
        top: 0;
    }

    .loader:before {
        left: -3.5em;
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .loader:after {
        left: 3.5em;
    }

    @-webkit-keyframes load7 {

        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }

        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }

    @keyframes load7 {

        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }

        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }

    .show {
        visibility: visible;
    }

    .spanner {
        opacity: 0;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .spanner.show {
        opacity: 1
    }
</style>

@endpush

@push('scripts')

<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script>
    var diamond_index_url = "{{ route('product.index') }}";
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone", {
        url: "{{ route('product.excel.upload') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        thumbnailWidth: 200,
        thumbnailHeight: 200,
        addRemoveLinks: true,
        paramName: "excel_file",
        acceptedFiles: ".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel",
        maxFilesize: 2, // MB
        maxFiles: 1,
        // autoProcessQueue: false,
        init: function() {

            this.on('sending', function(file, xhr, formData) {
                $("div.spanner").addClass("show");
                $("div.overlay").addClass("show");
            })

            this.on("success", function(file, response) {
                if (response.status == 'success') {
                    notify_bar('success', 'Excel import Successful.')
                    $("div.spanner").removeClass("show");
                    $("div.overlay").removeClass("show");
                    myDropzone.removeFile(file);
                    setTimeout(function() {
                        window.location.href = diamond_index_url;
                    }, 3000);
                } else {
                    notify_bar('danger', 'Something went wrong. Please try again.')
                    myDropzone.removeFile(file);
                }
            })

            this.on("removedfile", function(file) {
                var excel_file = $('.excel-file').val();
                $.ajax({
                    url: "{{ route('product.excel.remove') }}",
                    type: "post",
                    data: {
                        excel_file: excel_file
                    },
                    async: false,
                    success: function(response) {
                        if (response.status == 'failed') {
                            notify_bar('success', 'File has been removed.')
                        }
                    }
                })
            })
        }
    })
</script>

@endpush