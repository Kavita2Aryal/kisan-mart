@push('styles')
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script>
    var min_width = "{{ config('app.addons_config.image_min_width') }}";
    var min_height = "{{ config('app.addons_config.image_min_height') }}";
    var media_url = "{{ route('media.get.image') }}";
    var upload_modal_url = "{{ route('media.upload.image.modal') }}";
</script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/media.use.min.js') }}"></script>
@endpush