@php
use App\Helpers\Support;
use Illuminate\Support\Facades\Session;

$support = new Support();
$auth = (Auth::check() && Auth::user()->hasVerifiedEmail()) ? true : false;
$carts = $support->_customer ? (Session::has('cart_products') ? Session::get('cart_products') : $support->cart_get()) : [];
$cart_count = $support->_customer ? $support->cart_count() : 0;
$wishlists = $support->_customer ? (Session::has('wishlist_products') ? Session::get('wishlist_products') : $support->wishlist_get()) : [];
$desktop_menus = $desktop != null ? json_decode($desktop, true) : [];
$mobile_menus = $mobile != null ? json_decode($mobile, true) : [];
$currency_preferences = get_currency_preferences();
$currencies = $currency_preferences->currencies;
$currency = $currency_preferences->currency;
@endphp
<!-- @include('includes.currency-nav', ['currency' => $currency, 'currencies' => $currencies]) -->

<div class="tm-header-mobile uk-hidden@m">
    <div class="uk-navbar-container">
        <nav uk-navbar="container: .tm-header-mobile">
            <div class="uk-navbar-center">
                <a href="{{ route('home') }}" class="uk-navbar-item uk-logo"> <img alt="Sutkeri" width="140" src="{{ url('storage/website/logo.svg') }}" /></a>
            </div>

            <div class="uk-navbar-right">
                <a class="uk-navbar-toggle" href="#tm-mobile" uk-toggle>
                    <div uk-navbar-toggle-icon></div>
                </a>
            </div>
        </nav>
    </div>

    <div id="tm-mobile" class="uk-modal-full" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-height-viewport">
            <button class="uk-modal-close-full" type="button" uk-close></button>

            <div class="uk-child-width-1-1" uk-grid>
                <div>
                    <div class="uk-panel" id="module-menu-mobile">
                        <ul class="uk-nav uk-nav-default uk-nav-divider">
                            <li class="item-101 uk-active">
                                <a href="{{ route('home') }}"><img alt="Home" width="150" uk-svg src="{{ url('storage/website/logo-nav.svg') }}" /> </a>
                            </li>
                            <li>
                            <div class="uk-flex">
                                <div uk-form-custom="target: > * > span:last-child" class="uk-form-custom">
                                    @if($currencies != null)
                                    <select class="preferred-currency-dropdown-item">
                                        @foreach($currencies as $row)
                                        <option value="{{ $row->id }}" @if($row->id == $currency->preference) selected @endif>{!! strtoupper($row->currency) !!}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <span class="uk-link">
                                        <span uk-icon="icon:  triangle-down"></span>
                                        <span></span>
                                    </span>
                                </div>
                                <div class="uk-margin-auto-left uk-flex">
                                    <div class="uk-margin-remove-last-child custom">
                                        <div class="uk-inline">
                                            <a href="{{ ($auth) ? route('dashboard') : route('login') }}" class="uk-margin-remove uk-padding-remove"><img width="28" height="28" src="{{ url('storage/website/user.svg') }}" style="width: 28px;" /></a>
                                        </div>
                                    </div>
                                    <div class="uk-margin-left">
                                        <a href="{{ route('wishlist.index') }}"><img src="{{ url('storage/website/wishlist.svg') }}" style="width: 28px;" width="28" height="28"></a>
                                    </div>
                                    <div class="uk-margin-left uk-position-relative">
                                        <a href="{{ route('cart.index') }}"><img src="{{ url('storage/website/cart.svg') }}" uk-svg="" style="width: 24px;"></a>
                                        @if($auth)
                                            <span class="uk-badge uk-position-absolute item-count cart-count header-cart-count cart-number" style="left: 12px;">{{ $cart_count }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            </li>
                            <li>
                                <form class="uk-search uk-search-default uk-width-1-1" action="{{route('search')}}" method="GET">
                                    <span uk-search-icon></span>
                                    <input class="uk-search-input" type="search" placeholder="Search" name="q" value="{{ (isset($_GET['q']) && $_GET['q'] != null) ? $_GET['q'] : '' }}" />
                                </form>
                            </li>
                            @if($mobile_menus != null)
                                @foreach($mobile_menus as $key => $menu)
                                    @if(isset($menu['children']))
                                        <li class="js-accordion uk-parent">
                                            <ul class="uk-nav-sub">
                                                <li>
                                                    <div class="uk-section-default uk-section uk-section-small uk-padding-remove-top">
                                                        <div class="uk-container uk-container-large">
                                                            <div class="tm-grid-expand uk-grid-margin paddingremove" uk-grid>
                                                                @php $child = array_slice($menu['children'],0,2); @endphp
                                                                @foreach($child as $gchild)
                                                                    @if(isset($gchild['children']))
                                                                        <div class="uk-width-1-2@s uk-width-1-4@m">
                                                                            <h4 class="uk-h5 box inverse-head">{{ $gchild['text'] }}</h4>
                                                                            <ul class="uk-list uk-list-divider">
                                                                                @foreach($gchild['children'] as $ggchild)
                                                                                    <li class="el-item">
                                                                                        <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-middle" uk-grid>
                                                                                            <div class="uk-width-auto">
                                                                                                <a href="{{ $ggchild['href'] }}" target="{{ $ggchild['target'] }}"><span class="el-image" uk-icon="icon: arrow-right;"></span></a>
                                                                                            </div>
                                                                                            <div>
                                                                                                <div class="el-content uk-panel uk-text-bold"><a href="{{ $ggchild['href'] }}" target="{{ $ggchild['target'] }}" class="el-link uk-margin-remove-last-child">{{ $ggchild['text'] }}</a></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="uk-width-1-1@s uk-width-1-2@m">
                                                                    <div id="gallery-hover-image" class="gallery-hover-image uk-margin uk-text-left">
                                                                        <div class="uk-child-width-1-1 uk-child-width-1-3@m uk-grid-small" uk-grid>
                                                                            @php $child = array_slice($menu['children'],2); @endphp
                                                                            @foreach($child as $gchild)
                                                                                @if(!isset($gchild['children']))
                                                                                    <div>
                                                                                        <div class="uk-light">
                                                                                            <a class="el-item uk-inline-clip uk-transition-toggle uk-link-toggle" href="{{ $gchild['href'] }}" target="{{ $gchild['target'] }}">
                                                                                                @if($gchild['image'] != '')
                                                                                                    <img
                                                                                                        src="{{ secure_img($gchild['image'], 'main') }}"
                                                                                                        sizes="(min-width: 600px) 600px"
                                                                                                        data-width="600"
                                                                                                        data-height="550"
                                                                                                        alt
                                                                                                        class="el-image uk-transition-scale-up uk-transition-opaque lozad"
                                                                                                    />
                                                                                                @endif
                                                                                                <div class="uk-tile-secondary uk-position-cover"></div>
                                                                                                <div class="uk-position-bottom-left">
                                                                                                    <div class="uk-overlay uk-padding-small uk-margin-remove-first-child">
                                                                                                        {!! $gchild['text'] !!}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="{{ $menu['href'] }}" target="{{ $menu['target'] }}"> {{ $menu['text'] }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                            @if($auth)
                            <li>
                                <a href="{{ route('logout') }}" class="uk-link uk-text-warning" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @if(isset($social_medias) && $social_medias != null)
                    <div>
                        <div class="uk-panel" id="module-tm-2">
                            <div class="uk-margin-remove-last-child custom">
                                <ul class="uk-flex-inline uk-flex-middle uk-flex-nowrap uk-grid-small" uk-grid>
                                    @foreach($social_medias as $social_media)
                                        <li>
                                            <a href="{!! $social_media['link'] !!}" class="uk-icon-link" target="_blank" uk-icon="icon: {!! $social_media['social'] !!};"></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="tm-header uk-visible@m" uk-header>
    <div class="tm-headerbar-default tm-headerbar tm-headerbar-top">
        <div class="uk-container uk-container-large uk-flex uk-flex-middle">
            <a href="{{ route('home') }}" class="uk-logo"> <img alt="Sutkeri" width="200" src="{{ url('storage/website/logo.svg') }}" /><img class="uk-logo-inverse" alt="Sutkeri" width="200" src="{{ url('storage/website/logo-inverse.svg') }}" /></a>

            <div class="uk-margin-auto-left">
                <div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid>
                    <div>
                        <div class="uk-panel" id="module-111">
                            <div class="uk-margin-remove-last-child custom" style="background-image: url('/');">
                                <div class="">
                                    <form class="uk-search uk-search-default" action="{{route('search')}}" method="GET">
                                        <span uk-search-icon></span>
                                        <input class="uk-search-input" type="search" placeholder="Search" name="q" value="{{ (isset($_GET['q']) && $_GET['q'] != null) ? $_GET['q'] : '' }}" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($social_medias) && $social_medias != null)
                        <div>
                            <div class="uk-panel" id="module-tm-1">
                                <div class="uk-margin-remove-last-child custom">
                                    <ul class="uk-flex-inline uk-flex-middle uk-flex-nowrap uk-grid-small" uk-grid>
                                        @foreach($social_medias as $social_media)
                                            <li>
                                                <a href="{!! $social_media['link'] !!}" class="uk-icon-link" target="_blank" uk-icon="icon: {!! $social_media['social'] !!};"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div uk-sticky media="@m" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-container">
        <div class="uk-navbar-container">
            <div class="uk-container uk-container-large uk-flex uk-flex-middle">
                <nav class="uk-navbar uk-flex-auto" uk-navbar='{"align":"left","boundary":".tm-header .uk-navbar-container","container":".tm-header &gt; [uk-sticky]"}'>
                    <div class="uk-navbar-left uk-flex-auto">
                        <ul class="uk-navbar-nav nav">
                            <li class="item-101 uk-active">
                                <a href="{{ route('home') }}"><img alt="Home" uk-svg src="{{ url('storage/website/logo-nav.svg') }}" /> </a>
                            </li>
                            @if($desktop_menus != null)
                                @foreach($desktop_menus as $key => $menu)
                                    @if(isset($menu['children']))
                                        <li class="item-140 uk-parent">
                                            <a> {{ $menu['text'] }}</a>
                                            
                                            <div
                                                class="jp-megamenu-dropdown uk-navbar-dropdown"
                                                uk-drop='{"clsDrop":"uk-navbar-dropdown","flip":"x","pos":"bottom-justify","boundary":".tm-header .uk-navbar-container","boundaryAlign":true,"mode":"hover","container":".tm-header &gt; [uk-sticky]"}'
                                                style="width: auto !important;"
                                            >
                                                <div class="uk-section-default uk-section uk-section-small uk-padding-remove-top">
                                                    <div class="uk-container uk-container-large">
                                                        <div class="tm-grid-expand uk-grid-margin" uk-grid>
                                                            @php $child = array_slice($menu['children'],0,2); @endphp
                                                            @foreach($child as $gchild)
                                                                @if(isset($gchild['children']))
                                                                    <div class="uk-width-1-2@s uk-width-1-4@m">
                                                                        <h4 class="uk-h5 box inverse-head">{{ $gchild['text'] }}</h4>
                                                                        <ul class="uk-list uk-list-divider">
                                                                            @foreach($gchild['children'] as $ggchild)
                                                                            <li class="el-item">
                                                                                <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-middle" uk-grid>
                                                                                    <div class="uk-width-auto">
                                                                                        <a href="{{ $ggchild['href'] }}" target="{{ $ggchild['target'] }}"><span class="el-image" uk-icon="icon: arrow-right;"></span></a>
                                                                                    </div>
                                                                                    <div>
                                                                                        <div class="el-content uk-panel uk-text-bold"><a href="{{ $ggchild['href'] }}" target="{{ $ggchild['target'] }}" class="el-link uk-margin-remove-last-child">{{ $ggchild['text'] }}</a></div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <div class="uk-width-1-1@s uk-width-1-2@m">
                                                                <div id="gallery-hover-image" class="gallery-hover-image uk-margin uk-text-left">
                                                                    <div class="uk-child-width-1-1 uk-child-width-1-3@m uk-grid-small" uk-grid>
                                                                        @php $child = array_slice($menu['children'],2); @endphp
                                                                        @foreach($child as $gchild)
                                                                            @if(!isset($gchild['children']))
                                                                                <div>
                                                                                    <div class="uk-light">
                                                                                        <a class="el-item uk-inline-clip uk-transition-toggle uk-link-toggle" href="{{ $gchild['href'] }}" target="{{ $gchild['target'] }}">
                                                                                            @if($gchild['image'] != '')
                                                                                                <img
                                                                                                    src="{{ secure_img($gchild['image'], 'main') }}"
                                                                                                    sizes="(min-width: 600px) 600px"
                                                                                                    data-width="600"
                                                                                                    data-height="550"
                                                                                                    alt
                                                                                                    class="el-image uk-transition-scale-up uk-transition-opaque lozad"
                                                                                                />
                                                                                            @endif
                                                                                            <div class="uk-tile-secondary uk-position-cover"></div>
                                                                                            <div class="uk-position-bottom-left">
                                                                                                <div class="uk-overlay uk-padding-small uk-margin-remove-first-child">
                                                                                                    {!! $gchild['text'] !!}
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li><a href="{{ $menu['href'] }}" target="{{ $menu['target'] }}"> {{ $menu['text'] }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>

                        <div class="uk-margin-auto-left uk-navbar-item" id="module-110">
                            <div class="uk-margin-remove-last-child custom">
                                <div class="uk-inline">
                                    @if($auth)
                                    <a href="javascript:void(0);"><img src="{{ url('storage/website/user.svg') }}" uk-svg style="width: 24px;" /></a>
                                    <div uk-dropdown="mode: click">
                                        <div class="">
                                            <ul class="uk-nav">
                                                <li class="item-209"><a href="{{ route('dashboard') }}"> Dashboard</a></li>
                                                <li class="item-211"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                            </ul>
                                        </div>
                                    </div>
                                    @else
                                    <a href="{{ route('login') }}" class="uk-margin-remove uk-padding-remove"><img width="28" height="28" src="{{ url('storage/website/user.svg') }}" style="width: 28px;" /></a>
                                    @endif    
                                </div>
                            </div>
                        </div>

                        <div class="uk-navbar-item" id="module-112">
                            <div class="uk-margin-remove-last-child custom" style="background-image: url('/');">
                                <div class="uk-position-relative">
                                    <a uk-toggle="target: #wish-flip" href="javascript:void(0);"><img src="{{ url('storage/website/wishlist.svg') }}" style="width: 28px;" width="28" height="28" /></a>
                                </div>

                                <div id="wish-flip" uk-offcanvas="flip: true; overlay: true" style="z-index: 999;">
                                    <div class="uk-offcanvas-bar">
                                        <button class="uk-offcanvas-close" type="button" uk-close></button>

                                        <h3 class="uk-text-center">WISHLIST</h3>
                                        <hr />
                                        <div class="wishlist-product-list @if(count($wishlists) == 0) hidden @endif">
                                            @include('includes.wishlist-flip', ['auth' => $auth, 'wishlists' => $wishlists])
                                        </div>
                                        <div class="uk-text-center uk-margin-large empty-wishlist @if(count($wishlists) > 0) hidden @endif">
                                            <img src="{{ url('storage/website/wishlist.svg') }}" style="width: 120px;" />
                                            <p class="uk-h5">Your Wishlist is empty.</p>
                                            <p class="uk-text-large uk-margin-remove">
                                                Don't hesitate and browse our catalog to find something for You!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="uk-navbar-item" id="module-109">
                            <div class="uk-margin-remove-last-child custom" style="background-image: url('/');">
                                <div class="uk-position-relative">
                                    <a uk-toggle="target: #cart-flip" href="javascript:void(0);"><img src="{{ url('storage/website/cart.svg') }}" uk-svg style="width: 24px;" />
                                        @if($auth)
                                            <span class="uk-badge uk-position-absolute item-count cart-count header-cart-count cart-number @if($cart_count == 0) hidden @endif" style="left: 12px;">
                                                {{ $cart_count }}
                                            </span>
                                        @endif
                                    </a>
                                </div>

                                <div id="cart-flip" uk-offcanvas="flip: true; overlay: true">
                                    <div class="uk-offcanvas-bar">
                                        <button class="uk-offcanvas-close" type="button" uk-close></button>
                                        <h3 class="uk-text-center">MY BAG</h3>
                                        <hr />
                                        <div class="cart-product-list @if(count($carts) == 0) hidden @endif">
                                            @include('includes.cart-flip', ['auth' => $auth, 'carts' => $carts])
                                        </div>
                                        <div class="uk-text-center uk-margin-large empty-cart @if(count($carts) > 0) hidden @endif">
                                            <img src="{{ url('storage/website/cart.svg') }}" style="width: 90px;" />
                                            <p class="uk-h5">Your Shopping Bag is empty.</p>
                                            <p>
                                                <a class="uk-button uk-button-default uk-width-1-1" href="{{ route('home') }}"> Browse Our Catalog</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<div id="system-message-container" data-messages="[]"></div>