@push('styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/alias.use.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script>
    summernote_init();
    var old_img_bool = false;
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone", {
        url: "{{ route('image.upload') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        thumbnailWidth: 200,
        thumbnailHeight: 200,
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
                    // if (this.width < img_min_width) { 
                    //     notify_flip('danger', 'Invalid image dimensions');
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
                formData.append("type", "ecommerce");
            });

            this.on("success", function(file, response) {
                if (response.status == 'success') {
                    $('.collection-image').val(response.filename)
                    notify_flip('success', 'Success', 'One Image Uploaded', '<i class="pg-icon">alert_info</i>');
                } else {
                    $('.collection-image').val('')
                    notify_flip('danger', 'Error', 'Something went wrong. Please try again.', '<i class="pg-icon">alert_info</i>');
                    myDropzone.removeFile(file);
                }
            });

            this.on("removedfile", function(file) {
                $('.collection-image').val('');
                old_img_bool = false;
            });

            this.on('addedfile', function(file) {
                if (old_img_bool) {
                    old_img_bool = false;
                    $('.dz-image-preview').remove();
                } else if (this.files.length > 1) {
                    myDropzone.removeFile(this.files[0]);
                }
            });
        }
    })

    @if(isset($collection) && $collection->image != '' && Storage::exists('public/ecommerce/'.$collection->image))
    var mockFile = {
        name: "{{ $collection->image }}",
        size: "{{ \Storage::size('public/ecommerce/'.$collection->image) }}"
    };
    myDropzone.emit("addedfile", mockFile);
    myDropzone.emit("thumbnail", mockFile, "{{ \Storage::url('public/ecommerce/'.$collection->image) }}");
    myDropzone.emit("complete", mockFile);
    old_img_bool = true;
    @endif
</script>
@endpush