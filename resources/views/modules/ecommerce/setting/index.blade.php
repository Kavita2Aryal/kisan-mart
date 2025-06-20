@extends('layouts.app')
@section('title', 'Ecommerce Settings')

@section('content')
<div class="container-fluid">
    @include('modules.ecommerce.setting.includes.vat')
    @include('modules.ecommerce.setting.includes.payment_options')
    @include('modules.ecommerce.setting.includes.offer')
    @include('modules.ecommerce.setting.includes.help')
    @include('modules.ecommerce.setting.includes.delivery')
    @include('modules.ecommerce.setting.includes.delivery-partner')
    @include('modules.ecommerce.setting.includes.made-with-love')
    @include('modules.ecommerce.setting.includes.happy-customer')
</div>

@include('modules.cms.media.use.script')

@endsection

@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
<script>
    var data = [];
    $(document).on('change', '.payment-options-checkbox', function(e) {
        e.preventDefault();
        $('.payment-options-checkbox').each(function() {
            var $this = $(this);
            var value = $this.val();
            if ($this.is(':checked')){
                if($.inArray(value, data) == -1) {
                    data.push(value);
                }
            } else {
                data = $.grep(data, function(item) {
                    return item != value;
                });
            }
        })
        console.log(data);
        $('.payment-option-value').val(data);
    })
    $(document).on('change', '.setting-toggle', function(e) {
        $(this).parents('.form-check').find('.form-value').val($(this).is(':checked') ? 'ON' : 'OFF');
    });
    $(document).ready(function() {
        $('[data-init-plugin=select2]').select2({});
    });
    $(document).on('change', '#popup-display-per-session', function(e) {
        $(this).is(':checked') ? $('.session-time').css('display', 'block') : $('.session-time').css('display', 'none');
    });
</script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
@endpush