@push('styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.css') }}" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/alias.use.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/collect.min.js') }}" type="text/javascript"></script>
<script>
    summernote_init_simple();
    $(document).ready(function() {
        $('[data-init-plugin=select2]').select2({});
    });
    var old_img_bool = false;
    var old_seo_bool = false;
    var currency = "{{ $currency }}";

    $(document).ready(function(){
        $('.product-lists-select2').select2({
            placeholder: 'Assign Products',
            ajax: {
                url: "{{ route('combo.product.autosearch') }}",
                type: 'GET',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 1,
        });
    });

    // 
    // $(document).ready(function(){
    //     $(".color-option-value").select2({
    //         ajax: {
    //             url: "{{ route('color.search') }}",
    //             dataType: 'json',
    //             type: "GET",
    //             delay: 250,
    //             processResults: function (data) {
    //                 return {
    //                     results: $.map(data, function (item) {
    //                         return {
    //                             text: item.name,
    //                             id: item.id
    //                         }
    //                     })
    //                 };
    //             },
    //             cache: true
    //         }
    //     });
    // })

    // $(document).ready(function(){
    //     $(".size-option-value").select2({
    //         ajax: {
    //             url: "{{ route('size.search') }}",
    //             dataType: 'json',
    //             type: "GET",
    //             delay: 250,
    //             processResults: function (data) {
    //                 return {
    //                     results: $.map(data, function (item) {
    //                         return {
    //                             text: item.name,
    //                             id: item.id
    //                         }
    //                     })
    //                 };
    //             },
    //             cache: true
    //         }
    //     });
    // })
</script>
<script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script>
    var color_dropzones = [];
    var mockfiles = [];
    var url_product_check = "{{ route('product.check', [$uuid]) }}";
    var url_upload_image = "{{ route('image.upload') }}";
    var url_remove_image = "{{ route('image.remove') }}";
    var type = @isset($product)
    "edit"
    @else "create"
    @endisset;
    var product_variants_arr = @if(isset($product) && $product-> has_variant == 10) @json($product-> variants) @else null
    @endif;
    var product_color_image_arr = @isset($color_image_arr) @json($color_image_arr) @else[] @endisset;
    var mockfiles = @isset($mockfiles) @json($mockfiles) @else ''
    @endisset;
    var colors_all = @isset($colors) @json($colors) @else[] @endisset;
    var sizes_all = @isset($sizes) @json($sizes) @else[] @endisset;
    var product_selected_colors = @if(isset($product) && isset($selected_colors)) @json($selected_colors) @else['default'] @endif;
    var product_selected_sizes = @if(isset($product) && isset($selected_sizes)) @json($selected_sizes) @else['default'] @endif;

    Dropzone.autoDiscover = false;
    var myDropzone1 = new Dropzone(".dropzone-1", {
        url: url_upload_image,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        thumbnailWidth: 20,
        thumbnailHeight: 20,
        addRemoveLinks: true,
        paramName: "image",
        acceptedFiles: "image/*",
        maxFilesize: 2, // MB
        maxFiles: 1,
        // autoProcessQueue: false,
        accept: function(file, done) {
            var reader = new FileReader();
            reader.onload = (function(elem) {
                var image = new Image();
                image.src = elem.target.result;
                image.onload = function() {
                    // if (this.width < prod_min_width) { 
                    //     notify_circle('danger', 'Invalid image dimensions');
                    //     done("Invalid dimensions");
                    // }
                    // else { done(); }

                    done();
                };
            });
            reader.readAsDataURL(file);
        },
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                formData.append("type", "product");
            });

            this.on("success", function(file, response) {
                if (response.status == 'success') {
                    $('#thumbnail-image').val(response.filename)
                    notify_circle('success', 'Success', 'One Image Uploaded', '<i class="pg-icon">alert_info</i>');
                } else {
                    $('#thumbnail-image').val('')
                    notify_circle('danger', 'Error', 'Something went wrong. Please try again.', '<i class="pg-icon">alert_info</i>');
                    myDropzone1.removeFile(file);
                }
            });

            this.on("removedfile", function(file) {
                $('#thumbnail-image').val('');
                old_img_bool = false;
            });

            this.on('addedfile', function(file) {
                if (old_img_bool) {
                    old_img_bool = false;
                    this.element.children[1].remove();
                } else if (this.files.length > 1) {
                    myDropzone1.removeFile(this.files[0]);
                }
            });
        }
    });
    var myDropzone2 = new Dropzone(".dropzone-2", {
        url: url_upload_image,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        thumbnailWidth: 20,
        thumbnailHeight: 20,
        addRemoveLinks: true,
        paramName: "image",
        acceptedFiles: "image/*,pdf",
        maxFilesize: 2, // MB
        maxFiles: 10,
        uploadMultiple: false,
        // autoProcessQueue: false,
        accept: function(file, done) {
            var reader = new FileReader();
            reader.onload = (function(elem) {
                var image = new Image();
                image.src = elem.target.result;
                image.onload = function() {
                    // if (this.width < prod_min_width) { 
                    //     notify_circle('danger', 'Invalid image dimensions');
                    //     done("Invalid dimensions");
                    // }
                    // else { done(); }

                    done();
                };
            });
            reader.readAsDataURL(file);
        },
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                formData.append("type", "product");
            });

            this.on("success", function(file, response) {
                if (response.status == 'success') {
                    $('#gallery-images').append('<input type="hidden" name="gallery[]" data-image="' + file.name + '" value="' + response.filename + '"/>');
                    notify_circle('success', 'Success', 'One Image Uploaded', '<i class="pg-icon">alert_info</i>');
                } else {
                    notify_circle('danger', 'Error', 'Something went wrong. Please try again.', '<i class="pg-icon">alert_info</i>');
                    myDropzone2.removeFile(file);
                }
            });

            this.on("removedfile", function(file) {
                $img = file.name;
                $.ajax({
                    url: url_remove_image,
                    type: 'POST',
                    data: {
                        image: $img,
                        type: 'product'
                    },
                    async: false,
                    success: function(response) {
                        if (response.status == 'success') {
                            $('[data-image="' + file.name + '"]').remove();
                            notify_circle('success', 'Success', 'Image has been removed', '<i class="pg-icon">alert_info</i>');
                        } else {
                            notify_circle('danger', 'Error', 'Something went wrong. Please try again.', '<i class="pg-icon">alert_info</i>');
                        }
                    }
                })
            });

            this.on("maxfilesexceeded", function(file) {
                myDropzone2.removeFile(file);
                notify_circle('danger', 'Error', 'Only 10 files allowed', '<i class="pg-icon">alert_info</i>');
            });
        }
    });

    @if(isset($product->thumbnail) && $product->thumbnail != '' && Storage::exists('public/product/'.$product->thumbnail->image))
    var mockFile1 = {
        name: "{{ $product->thumbnail->image }}",
        size: "{{ \Storage::size('public/product/'.$product->thumbnail->image) }}"
    };
    myDropzone1.emit("addedfile", mockFile1);
    myDropzone1.emit("thumbnail", mockFile1, "{{ \Storage::url('public/product/'.$product->thumbnail->image) }}");
    myDropzone1.emit("complete", mockFile1);
    old_img_bool = true;
    @endif

    @if(isset($product->gallery_images) && $product->gallery_images != '')
    @foreach($product->gallery_images as $gallery)
    @if(Storage::exists('public/product/'.$gallery->image))
    var mockFile2 = {
        name: "{{ $gallery->image }}",
        size: "{{ \Storage::size('public/product/'.$gallery->image) }}"
    };
    myDropzone2.emit("addedfile", mockFile2);
    myDropzone2.emit("thumbnail", mockFile2, "{{ \Storage::url('public/product/'.$gallery->image) }}");
    myDropzone2.emit("complete", mockFile2);
    @endif
    @endforeach
    @endif
</script>

<script src="{{ asset('assets/js/collect.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/product.min.js') }}" type="text/javascript"></script>
<script>
    @if(isset($product) && $product->has_variant == 10)
    display_product_variant(product_selected_colors, product_selected_sizes);
    @endif
</script>
@endpush