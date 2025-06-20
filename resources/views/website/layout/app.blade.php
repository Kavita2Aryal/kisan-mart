<!DOCTYPE html>
<html lang="en-gb" dir="ltr" vocab="http://schema.org/">
<head>
    @php
    $currency = get_currency();
    @endphp
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ url('storage/website/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ url('storage/website/apple-touch-icon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-signin-client_id" content="486731037900-525td6751g8ldd5l02gbdo4cbokauk5m.apps.googleusercontent.com">
    @stack('seo')
    <link href="{{ asset('ecommerce/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('ecommerce/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('ecommerce/plugins/jquery-confirm/jquery-confirm.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('ecommerce/js/jquery.min.js') }}"></script>
    <script src="{{ asset('ecommerce/js/uikit.min.js') }}"></script>
    <script src="{{ asset('ecommerce/js/uikit-icons-union-dental.min.js') }}"></script>
    <script src="{{ asset('ecommerce/js/theme.js') }}"></script>
    <script src="{{ asset('ecommerce/js/newsletter.min.js') }}" defer></script>
    @stack('styles')
    <style>.grecaptcha-badge {visibility: hidden;}</style>
</head>
<body>
    @php $request_url = $_SERVER['REQUEST_URI']; @endphp
    @if($request_url == "/")
        @include('includes.home-popup')
    @endif
    <div class="tm-page">
        @yield('frontend-content')
    </div>
    <script src="{{ asset('ecommerce/js/jquery-3.4.1.min.js' )}}"></script>
    <script type="text/javascript" src="{{ asset('ecommerce/plugins/jquery-confirm/jquery-confirm.min.js')}}"></script>
    @include('includes.policy-popup')
    @stack('popups')
    <script type="text/javascript" src="{{ asset('ecommerce/js/lozad.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('ecommerce/custom/function.min.js') }}" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

    @if($settings['google-analytics-status'] == 'ON')
        {!! $settings['google-analytics-embed'] !!}
    @endif
    @if($settings['hotjar-status'] == 'ON'){
        {!! $settings['hotjar-embed'] !!}
    @endif

    @stack('scripts')
    <script>
        var currency = "{{ $currency->name }}", ex_rate = "{{ $currency->rate }}", add_to_cart_url = "{{ route('cart.addup') }}",
        update_cart_url = "{{ route('cart.update') }}", remove_from_cart_url = "{{ route('cart.remove') }}", cart_url = "{{ route('cart.index') }}",
        add_to_wishlist_url = "{{ route('wishlist.update') }}", remove_from_wishlist_url = "{{ route('wishlist.remove') }}", maxQty = {{ (int) config('app.addons_config.maximum_quantity'); }};
    </script>
    <script type="text/javascript" src="{{ asset('ecommerce/custom/product.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ecommerce/custom/gift-voucher.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ecommerce/custom/support.min.js') }}"></script>
    @include('includes.notification.notify')
    @include('includes.notification.modal')
</body>
</html>
