@push('styles')
<link href="{{ asset('ecommerce/plugins/jquery-ui-slider/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script>
    var min_price = {{ (int) $min_price }};
    var max_price = {{ (int) $max_price }};
    var min_price_value = {{ (isset($_GET['min_prange']) && $_GET['min_prange'] != null) ? (int) $_GET['min_prange']: 100 }};
    var max_price_value = {{ (isset($_GET['max_prange']) && $_GET['max_prange'] != null) ? (int) $_GET['max_prange']: (int) $max_price }};
</script>
<script src="{{ asset('ecommerce/plugins/jquery-ui-slider/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('ecommerce/plugins/jquery-ui-slider/touch-punch.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ecommerce/custom/product.search.min.js') }}"></script>
@endpush