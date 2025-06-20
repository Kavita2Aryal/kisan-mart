@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>

<script>
    $(document).on('click', '.btn-reply', function () {
        var uuid = $(this).data('uuid');
        $.ajax({
            type: 'get',
            url: "{{ route('product.question.answer.get.detail') }}",
            data: { uuid: uuid },
            async: false,
            success: function (response) {
                if (response.status) {
                    var $modal = $('.modal-question-answer');
                    $modal.html(response.html);
                    $modal.modal('show');
                }
            }
        })
    });
    $(document).on('click', '.btn-submit-reply', function () {
        var uuid = $(this).data('uuid');
        var $modal = $('.modal-question-answer');
        var answer = $modal.find('.answer').val();
        $.ajax({
            type: 'post',
            url: "{{ route('product.question.answer.update') }}",
            data: { uuid: uuid, answer: answer },
            async: false,
            success: function (response) {
                if (response.status) {
                    notify_bar('success', 'Answer has been submitted.');
                    window.location.href = response.url;
                }else{
                    notify_bar('error', 'Something went wrong! Please try again later.');
                }
            }
        })
    })
</script>
@endpush