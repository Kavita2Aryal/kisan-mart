@push('styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" />

@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/collection.min.js') }}" type="text/javascript"></script>
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
        $('.promocode').val(generate_code());
    });
</script>

@endpush