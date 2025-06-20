@push('styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/alias.use.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script>
    var fromTimeInput = $('.start-date');
    var toTimeInput = $('.end-date');
    var fromTime = fromTimeInput.val();
    var toTime = toTimeInput.val();
    fromTimeInput.datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        default: true,
        autoclose: true,
        widgetPositioning: {
            horizontal: "bottom",
            vertical: "auto"
        }
    });
    toTimeInput.datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        default: true,
        startDate: fromTime,
        autoclose: true,
        widgetPositioning: {
            horizontal: "bottom",
            vertical: "auto"
        }
    });
    fromTimeInput.on("changeDate", function(e) {
        toTimeInput.val('');
        toTimeInput.datetimepicker('setStartDate', e.date);
    });
    toTimeInput.on("changeDate", function(e) {
        fromTimeInput.datetimepicker('setEndDate', e.date);
    });

    var generate_code = function() {
        var charSet = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        var randomString = '';
        for (var i = 0; i < 8; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz, randomPoz + 1);
        }
        return randomString.toUpperCase();
    }

    $(document).on('click', '.btn-generate-code', function(e) {
        e.preventDefault();
        $('.gift-voucher').val(generate_code());
    });
    summernote_init_simple();
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
                    $('.gift-voucher-image').val(response.filename)
                    notify_flip('success', 'Success', 'One Image Uploaded', '<i class="pg-icon">alert_info</i>');
                } else {
                    $('.gift-voucher-image').val('')
                    notify_flip('danger', 'Error', 'Something went wrong. Please try again.', '<i class="pg-icon">alert_info</i>');
                    myDropzone.removeFile(file);
                }
            });

            this.on("removedfile", function(file) {
                $('.gift-voucher-image').val('');
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

    @if(isset($gift_voucher) && $gift_voucher->image != '' && Storage::exists('public/ecommerce/'.$gift_voucher->image))
    var mockFile = {
        name: "{{ $gift_voucher->image }}",
        size: "{{ \Storage::size('public/ecommerce/'.$gift_voucher->image) }}"
    };
    myDropzone.emit("addedfile", mockFile);
    myDropzone.emit("thumbnail", mockFile, "{{ \Storage::url('public/ecommerce/'.$gift_voucher->image) }}");
    myDropzone.emit("complete", mockFile);
    old_img_bool = true;
    @endif
</script>
@endpush