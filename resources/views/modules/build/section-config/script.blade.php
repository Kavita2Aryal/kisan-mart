<script>
var image_url = "{{ url('storage/cms/section/') }}/";
var list_url = "{{ route('section.config.generate.form') }}";
var upload_url = "{{ route('section.config.upload.image') }}";
var remove_url = "{{ route('section.config.remove.image') }}";
$(document).on('click', '.section-item', function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).data('url'),
        type: 'put',
        async: false,
        success: function (response) {
            $('.update-section-container').html(response.html);
            dropzone_init(response.filename, response.size);
        }
    });
});
$(document).on('change', '.has-number', function (e) {
    var $input = $(this).parents('.number-content').find('.number-option');
    if ($(this).is(':checked') && $(this).val() == 1) { 
        $input.show();
        $input.find('.input-sm').val(1);
    }
    else {
        $input.hide();
        $input.find('.input-sm').val(0);
    }
});
$(document).on('change', '.has-type', function (e) {
    var $type = $(this).parents('.type-content');
    if ($(this).is(':checked') && $(this).val() == 1) { 
        $type.find('.type-title').show();
        $type.find('.type-option').show();
    }
    else {
        $type.find('.type-title').hide();
        $type.find('.type-option').hide();
        $type.find('input[type=checkbox]').prop('checked', false);
    }
});
$(document).on('change', '.has-style', function (e) {
    var $style = $(this).parents('.style-content');
    if ($(this).is(':checked') && $(this).val() == 1) { 
        $style.find('.style-title').show();
        $style.find('.style-option').show();
    }
    else {
        $style.find('.style-title').hide();
        $style.find('.style-option').hide();
        $style.find('input[type=checkbox]').prop('checked', false);
    }
});
$(document).on('change', '.has-script', function (e) {
    var $script = $(this).parents('.script-content');
    if ($(this).is(':checked') && $(this).val() == 1) { 
        $script.find('.script-title').show();
        $script.find('.script-option').show();
    }
    else {
        $script.find('.script-title').hide();
        $script.find('.script-option').hide();
        $script.find('input[type=checkbox]').prop('checked', false);
    }
});
$(document).on('change', '.has-list', function (e) {
    var $list = $(this).parents('.list-content');
    if ($(this).is(':checked') && $(this).val() == 1) { 
        $list.find('.list-btn').show();
        $list.find('.list-option').show();
        // $list.find('input[type=number]').val(1);
        // $list.find('input[type=radio]').each(function () {
        //     if ($(this).val() == 0) {
        //         $(this).attr('checked', false);
        //     }
        //     else {
        //         $(this).attr('checked', true);
        //         if ($(this).hasClass('has-number')) {
        //             $(this).trigger('change');
        //         }
        //     }
        // });
    }
    else {
        $list.find('.list-btn').hide();
        $list.find('.list-option').hide();
        $list.find('input[type=number]').val(0);
        $list.find('input[type=radio]').each(function () {
            if ($(this).val() == 1) {
                $(this).attr('checked', false);
            }
            else {
                $(this).attr('checked', true);
            }
        });
    }
});
$(document).on('click', '.btn-add-list', function (e) {
    e.preventDefault();
    var $parent = $(this).parents('.list-content');
    var count = $parent.find('.list-count').val();
    var indexing = $(this).data('indexing');
    $.ajax({
        url: list_url,
        type: "post",
        data: { count: count, type: 'list', indexing: indexing },
        async: false,
        success: function (response) {
            $parent.find('.list-items').append(response.html);
            $parent.find('.list-count').val(++count);
        }
    });
});
$(document).on('click', '.btn-remove-list', function (e) {
    e.preventDefault();
    if ($(this).parents('.list-content').find('.list-item').length > 1) {
        $(this).parents('.list-item').remove();
    }
    else {
        notify_bar('danger', 'List require at least one content.');
    }
});
$(document).on('click', '.btn-delete', function (e) {
    e.preventDefault(); 
    var $this = $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            if ($this.data('uuid') == 0) {
                var filename = $this.parents('.parent-section').find('.section-filename').val();
                $.ajax({
                    url: remove_url,
                    type: "post",
                    data: { image: filename},
                    async: false,
                    success: function (response) {
                        $('[value="'+filename+'"]').remove();
                        if (response.status == 'failed') {
                            notify_bar('danger', 'Something went wrong');
                        }
                    }
                });
            }
            else {
                console.log($this.data('uuid'));
                $('form.delete-form-'+$this.data('uuid')).submit();
            }
            $this.parents('.parent-section').remove();
        }
    });
});
$(document).on('click', '.btn-save', function (e) {
    $('.parent-section').each(function () {
        var count_radio = 0;
        $(this).find('input[type=radio]:checked').not('.ignore-config-count').each(function () {
            if ($(this).val() == 1) { count_radio++; }
        });
        var count_check = 0;
        $(this).find('input[type=checkbox]:checked').not('.ignore-config-count').each(function () {
            if ($(this).val() == 1) { count_check++; }
        });
        var count_number = 0;
        $(this).find('.has-number').each(function () {
            if ($(this).is(':checked') && $(this).val() == 1 && $(this).parents('.number-content').find('.number-option').find('.input-sm').val() <= 0) { count_number++; }
        });
        
        if (count_radio == 0 && count_check == 0) { 
            notify_bar('danger', 'Please select at least one content for each section.');
            e.preventDefault();
            return false;
        }
        if (count_number != 0) { 
            notify_bar('danger', 'The no. of the content must be greater than 0.');
            e.preventDefault();
            return false;
        }
    });
});
$(document).on('click', '.btn-update', function (e) {
    var $parent = $(this).parents('.parent-section');
    
    var count_radio = 0;
    $parent.find('input[type=radio]:checked').not('.ignore-config-count').each(function () {
        if ($(this).val() == 1) { count_radio++; }
    });
    var count_check = 0;
    $parent.find('input[type=checkbox]:checked').not('.ignore-config-count').each(function () {
        if ($(this).val() == 1) { count_check++; }
    });
    var count_number = 0;
    $parent.find('.has-number').each(function () {
        if ($(this).is(':checked') && $(this).val() == 1 && $(this).parents('.number-content').find('.number-option').find('.input-sm').val() <= 0) { count_number++; }
    });
    
    if (count_radio == 0 && count_check == 0) { 
        notify_bar('danger', 'Please select at least one content for each section.');
        e.preventDefault();
        return false;
    }
    if (count_number != 0) { 
        notify_bar('danger', 'The no. of the content must be greater than 0.');
        e.preventDefault();
        return false;
    }
});
</script>