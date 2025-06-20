@php
$uri_segment = request()->segment(1);
$tab_cms = in_array($uri_segment, config('app.config.grid_nav.cms'));
$tab_build = in_array($uri_segment, config('app.config.grid_nav.build'));
$tab_ecommerce = in_array($uri_segment, config('app.config.grid_nav.ecommerce'));
$tab_addons = in_array($uri_segment, config('app.config.grid_nav.addons'));
$tab_general = in_array($uri_segment, config('app.config.grid_nav.general'));
$tab_general = ($tab_cms || $tab_build || $tab_ecommerce || $tab_addons) ? false : true;
@endphp
<div class="quickview-wrapper builder" id="builder">
    <div class="p-l-30 p-r-30">
        <a class="builder-close quickview-toggle pg-icon" data-toggle="quickview" data-toggle-element="#builder">close_lg</a>
        <a class="builder-toggle" data-toggle="quickview" data-toggle-element="#builder">
            <img src="{{ asset('assets/img/cms-icons/general/hamburgermenu.svg') }}" alt="Menu" width="30">
        </a>
        <ul class="nav nav-tabs nav-tabs-simple nav-tabs-primary m-t-10" id="builderTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if($tab_general) active @endif" data-toggle="tab" href="#tabGeneral" role="tab" aria-controls="home"><span>General</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($tab_cms || $tab_build) active @endif" data-toggle="tab" href="#tabCms" role="tab" aria-controls="profile"><span>CMS</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($tab_ecommerce) active @endif" data-toggle="tab" href="#tabEcommerce" role="tab" aria-controls="profile"><span>Ecommerce</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($tab_addons) active @endif" data-toggle="tab" href="#tabAddons" role="tab" aria-controls="messages"><span>Addons</span></a>
            </li>
        </ul>
        <div class="tab-content m-b-30">
            <div class="tab-pane @if($tab_general) active @endif" id="tabGeneral" role="tabcard">
                <div class="scroll-wrapper scrollable">
                    <div class="scrollable scroll-content">
                        <div class="p-l-10 p-r-50">
                            <div class="row">
                                <div class="col-4">
                                    <a href="{{ route('dash.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/dashboard.svg') }}" alt="Dashboard" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Dashboard</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('setting.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/websettings.svg') }}" alt="Web Setting" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Web Setting</p>
                                        </div>
                                    </a>
                                </div>
                                @can('user.view')
                                <div class="col-4">
                                    <a href="{{ route('user.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/user.svg') }}" alt="Admin Users" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Admin Users</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('user.role.all')
                                <div class="col-4">
                                    <a href="{{ route('role.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/accessroles.svg') }}" alt="Access Roles" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Access Roles</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('activity.log')
                                <div class="col-4">
                                    <a href="{{ route('log.activity') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/activitylog.svg') }}" alt="Activity Log" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Activity Log</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                <div class="col-4">
                                    <a href="{{ route('dash.help') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/help.svg') }}" alt="Need Help" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Need Help</p>
                                        </div>
                                    </a>
                                </div>
                                <!-- @can('cache.clear')
                                <div class="col-4">
                                    <a href="{{ route('cache.clear') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/cacheclear.svg') }}" alt="Clear Cache" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Clear Cache</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan -->
                            </div>
                            @can('report.all')
                            <div class="row">
                                <div class="col-12">
                                    <div class="b-b b-dashed b-grey m-b-30"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <img src="{{ asset('assets/img/cms-icons/build/list.svg') }}" alt="Report" width="60">
                                    </div>
                                    <div class="m-l-10 m-t-20">
                                        <ul>
                                            <li>
                                                <a href="{{ route('report.sales') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Sales Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.best-seller') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Best Seller Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.product-category') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Category Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.product-brand') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Brand Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.cash-on-delivery') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Cash on Delivery Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.most-searched-keyword') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Most Searched Keyword Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.product-view') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Product View Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.cart') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Cart Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.wishlist') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Wishlist Report</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('report.cart.abandon') }}" class="menu-item-link">
                                                    <p class="font-montserrat m-t-5">Cart Abandon Report</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if($tab_cms || $tab_build) active @endif" id="tabCms" role="tabcard">
                <div class="scroll-wrapper scrollable">
                    <div class="scrollable scroll-content">
                        <div class="p-l-10 p-r-50">
                            <div class="row">
                                @can('page.view')
                                <div class="col-4">
                                    <a href="{{ route('page.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/cms/pages.svg') }}" alt="Pages" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Pages</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('menu.update')
                                <div class="col-4">
                                    <a href="{{ route('menu.desktop') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/cms/desktopmenu.svg') }}" alt="Desktop Menu" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Desktop Menu</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('menu.mobile') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/cms/mobilemenu.svg') }}" alt="Mobile Menu" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Mobile Menu</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('slider.all')
                                <div class="col-4">
                                    <a href="{{ route('slider.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/cms/slider.svg') }}" alt="Sliders" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Sliders</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('popup.all')
                                <div class="col-4">
                                    <a href="{{ route('popup.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/cms/pop-up.svg') }}" alt="Popups" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Popups</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('media.all')
                                <div class="col-4">
                                    <a href="{{ route('media.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/cms/mediagallery.svg') }}" alt="Media Gallery" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Media Gallery</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                <div class="col-4" style="display:none;">
                                    <a href="{{ route('web.alias.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/cms/alias.svg') }}" alt="Web Alias" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Web Alias</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @can('super.auth')
                            <div class="row">
                                <div class="col-12">
                                    <div class="b-b b-dashed b-grey m-b-30"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <a href="{{ route('section.config.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/build/sectionconfiguration.svg') }}" alt="Section Config" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Section Config</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('list.group.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/build/list.svg') }}" alt="List Group" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">List Group</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if($tab_ecommerce) active @endif" id="tabEcommerce" role="tabcard">
                <div class="scroll-wrapper scrollable">
                    <div class="scrollable scroll-content">
                        <div class="p-l-10 p-r-50">
                            <div class="row">
                                @can('order.all')
                                <div class="col-4">
                                    <a href="{{ route('order.pending') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/order.svg') }}" alt="Order" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Order</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('product.all')
                                <div class="col-4">
                                    <a href="{{ route('product.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/product.svg') }}" alt="Product" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Product</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('customer.all')
                                <div class="col-4">
                                    <a href="{{ route('customer.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/user.svg') }}" alt="Customers" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Customers</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('combo.product.all')
                                <div class="col-4">
                                    <a href="{{ route('combo.product.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/product.svg') }}" alt="Product" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">ComboProduct</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('category.all')
                                <div class="col-4">
                                    <a href="{{ route('category.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/productcategory.svg') }}" alt="Product Catgeory" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Product Catgeory</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('product.review.all')
                                <div class="col-4">
                                    <a href="{{ route('product.review.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/productreview.svg') }}" alt="Product Reviews" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Product Reviews</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('product.question.answer.all')
                                <div class="col-4">
                                    <a href="{{ route('product.question.answer.pending') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/productreview.svg') }}" alt="Product Reviews" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Product Q&A</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('policy.all')
                                <div class="col-4">
                                    <a href="{{ route('policy.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/build/list.svg') }}" alt="Brand" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Policy</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('brand.all')
                                <div class="col-4">
                                    <a href="{{ route('brand.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/brand.svg') }}" alt="Brand" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Brand</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('collection.all')
                                <div class="col-4">
                                    <a href="{{ route('collection.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/collection.svg') }}" alt="Collection" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Collection</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('offer.all')
                                <div class="col-4">
                                    <a href="{{ route('offer.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/offer.svg') }}" alt="Offer" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Offer</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('promocode.all')
                                <div class="col-4">
                                    <a href="{{ route('promocode.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/promocode.svg') }}" alt="Promo Code" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Promo Code</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('gift.voucher.all')
                                <div class="col-4">
                                    <a href="{{ route('gift.voucher.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/promocode.svg') }}" alt="Promo Code" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Gift Voucher</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('currency.all')
                                <div class="col-4">
                                    <a href="{{ route('currency.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/currency.svg') }}" alt="Currency" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Currency</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('country.all')
                                <div class="col-4">
                                    <a href="{{ route('country.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/country.svg') }}" alt="Country" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Country</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('region.all')
                                <div class="col-4">
                                    <a href="{{ route('region.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/region.svg') }}" alt="Region" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Region</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('city.all')
                                <div class="col-4">
                                    <a href="{{ route('city.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/city.svg') }}" alt="City" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">City</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('area.all')
                                <div class="col-4">
                                    <a href="{{ route('area.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/area.svg') }}" alt="Area" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Area</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('color.all')
                                <div class="col-4">
                                    <a href="{{ route('color.group.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/colorgroup.svg') }}" alt="Color Group" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Color Group</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('color.all')
                                <div class="col-4">
                                    <a href="{{ route('color.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/color.svg') }}" alt="Color" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Color</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('size.all')
                                <div class="col-4">
                                    <a href="{{ route('size.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/ecommerce/size.svg') }}" alt="Size" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Size</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                <div class="col-4">
                                    <a href="{{ route('ecommerce.setting.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/general/websettings.svg') }}" alt="Web Setting" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Ecommerce Setting</p>
                                        </div>
                                    </a>
                                </div>

                                    <div class="col-4">
                                        <a href="{{ route('delivery.index') }}" class="menu-item-link">
                                            <div class="text-center">
                                                <img src="{{ asset('assets/img/cms-icons/general/websettings.svg') }}" alt="Web Setting" width="60">
                                                <p class="font-montserrat m-t-5 m-b-30">Delivery Setting</p>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if($tab_addons) active @endif" id="tabAddons" role="tabcard">
                <div class="scroll-wrapper scrollable">
                    <div class="scrollable scroll-content">
                        <div class="p-l-10 p-r-50">
                            <div class="row">
                                @can('blog.all')
                                <div class="col-4">
                                    <a href="{{ route('blog.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/blog.svg') }}" alt="Blogs" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Blogs</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('blog.category.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/blogcategory.svg') }}" alt="Blogs Category" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Blogs Category</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('event.all')
                                <div class="col-4">
                                    <a href="{{ route('event.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/event.svg') }}" alt="Events" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Events</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('news.all')
                                <div class="col-4">
                                    <a href="{{ route('news.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/news.svg') }}" alt="News" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">News</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('author.all')
                                <div class="col-4">
                                    <a href="{{ route('author.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/author.svg') }}" alt="Authors" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Authors</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('faq.all')
                                <div class="col-4">
                                    <a href="{{ route('faq.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/faq.svg') }}" alt="FAQs" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">FAQs</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('partner.all')
                                <div class="col-4">
                                    <a href="{{ route('partner.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/partner.svg') }}" alt="Partners" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Partners</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('quick.link.all')
                                <div class="col-4">
                                    <a href="{{ route('quick.link.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/quicklink.svg') }}" alt="Quick Links" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Quick Links</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('social.media.all')
                                <div class="col-4">
                                    <a href="{{ route('social.media.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/socialmedia.svg') }}" alt="Social Media" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Social Media</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('team.all')
                                <div class="col-4">
                                    <a href="{{ route('team.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/teammember.svg') }}" alt="Team Members" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Team Members</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('testimonial.all')
                                <div class="col-4">
                                    <a href="{{ route('testimonial.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/testimonial.svg') }}" alt="Testimonials" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Testimonials</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('document.all')
                                <div class="col-4">
                                    <a href="{{ route('document.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/document.svg') }}" alt="Documents" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Documents</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('contact.all')
                                <div class="col-4">
                                    <a href="{{ route('contact.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/contact.svg') }}" alt="Contact Messages" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Contact Messages</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @can('newsletter.all')
                                <div class="col-4">
                                    <a href="{{ route('newsletter.index') }}" class="menu-item-link">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/img/cms-icons/addons/newsletter.svg') }}" alt="Newsletter Clients" width="60">
                                            <p class="font-montserrat m-t-5 m-b-30">Newsletter Clients</p>
                                        </div>
                                    </a>
                                </div>
                                @endcan
                                @if(get_setting('mailchimp-status') == 'ON')
                                    @can('mailchimp.status')
                                    <div class="col-4">
                                        <a href="{{ route('mailchimp.index') }}" class="menu-item-link">
                                            <div class="text-center">
                                                <img src="{{ asset('assets/img/cms-icons/addons/mailchimp.svg') }}" alt="Newsletter Clients" width="52">
                                                <p class="font-montserrat m-t-5 m-b-30">Mailchimp Email</p>
                                            </div>
                                        </a>
                                    </div>
                                    @endcan
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
