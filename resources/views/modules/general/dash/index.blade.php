@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
use Carbon\Carbon;
$start_year = config('app.config.start_year');
$current_year = Carbon::now()->format('Y');
$difference = $current_year - $start_year;
@endphp
<div class="container-fluid p-t-20">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs nav-tabs-fillup" role="tablist" style="position: relative;">
                <li class="nav-item">
                    <a class="active ecommerce-analytics" href="javascript:void(0);">Ecommerce Analytics</a>
                </li>
                @can('google.analytics')
                <li class="nav-item">
                    <a class="google-analytics" href="javascript:void(0);">Google Analytics</a>
                </li>
                @endcan
                <li class="nav-item-right hidden-800">
                    <a href="{{ route('dash.refresh') }}">
                        <small class="hint-text" data-tippy-content="Refresh Dashboard" data-tippy-placement="top-center">Last analysed at {{ $lastAnalysedAt }}</small>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Start Ecommerce Analytics -->
    <div class="m-t-20 ecommerce-analytics-content">
        @can('dashboard.tiles')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.this_week_sales')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.this_month_sales')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.this_year_sales')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.total_sales')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.transaction_and_conversion')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.customer_type')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.total_orders')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.completed_orders')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                        @include('modules.general.dash.includes.ecommerce.unfinished_orders')
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="display:none;">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        <div class="card" style="min-height: 165px;">
                            <div class="card-header">
                                <div class="card-title full-width">
                                    This Week Sales
                                </div>
                            </div>
                            <div class="card-body p-t-15">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                                        <img src="{{ asset('assets/img/cms-icons/ecommerce/currency.svg') }}" alt="visitor type" width="60">
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        <div class="card" style="min-height: 165px;">
                            <div class="card-header">
                                <div class="card-title full-width">
                                    This Month Sales
                                </div>
                            </div>
                            <div class="card-body p-t-15">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                                        <img src="{{ asset('assets/img/cms-icons/ecommerce/currency.svg') }}" alt="visitor type" width="60">
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        <div class="card" style="min-height: 165px;">
                            <div class="card-header">
                                <div class="card-title full-width">
                                    This Year Sales
                                </div>
                            </div>
                            <div class="card-body p-t-15">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                                        <img src="{{ asset('assets/img/cms-icons/ecommerce/currency.svg') }}" alt="visitor type" width="60">
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        <div class="card" style="min-height: 165px;">
                            <div class="card-header">
                                <div class="card-title full-width">
                                    Total Sales
                                </div>
                            </div>
                            <div class="card-body p-t-15">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                                        <img src="{{ asset('assets/img/cms-icons/ecommerce/currency.svg') }}" alt="visitor type" width="60">
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5 col-xlg-5">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                        <div class="card" style="min-height: 165px;">
                            <div class="card-header">
                                <div class="card-title full-width">
                                    Orders
                                </div>
                            </div>
                            <div class="card-body p-t-15">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                                        <img src="{{ asset('assets/img/cms-icons/ecommerce/order.svg') }}" alt="website vistors" width="65">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-5">
                                        <h5 class="font-montserrat fs-18 m-t-0">
                                            Total Orders: &nbsp;{{ $total_orders }}
                                        </h5>
                                        <p class="font-montserrat fs-18">
                                            Domestic Orders: &nbsp;{{ $country_wise_orders['domestic_orders'] }}
                                        </p>
                                        <p class="font-montserrat fs-18 m-b-0">
                                            International Orders: &nbsp;{{ $country_wise_orders['international_orders'] }}
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-5">
                                        <h5 class="font-montserrat fs-18 m-t-0">
                                            Converison Rate: &nbsp;{{ number_format($conversion_rate, 0, '', ',') . '%' }}
                                        </h5>
                                        <p class="font-montserrat fs-18">
                                            Completed Orders: &nbsp;{{ $completed_orders }}
                                        </p>
                                        <p class="font-montserrat fs-18">
                                            Unfinished Orders: &nbsp;{{ $unfinished_orders }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                        <div class="card" style="min-height: 165px;">
                            <div class="card-header">
                                <div class="card-title full-width">
                                    
                                </div>
                            </div>
                            <div class="card-body p-t-15">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                                        <img src="{{ asset('assets/img/cms-icons/general/visitors.svg') }}" alt="website vistors" width="65">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-5">
                                        <h5 class="font-montserrat fs-18 m-t-0">
                                            Total Customers: &nbsp;{{ $customers['total_customers'] }}
                                        </h5>
                                        <p class="font-montserrat fs-18">
                                            Repeated Customers: &nbsp;{{ $customers['repeated_customers'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('latest.orders')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                @include('modules.general.dash.includes.ecommerce.latest_orders')
            </div>
        </div>
        @endcan
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                @can('weekly.sales.chart')
                @include('modules.general.dash.includes.ecommerce.weekly_sales_chart')
                @endcan
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                @can('monthly.sales.chart')
                @include('modules.general.dash.includes.ecommerce.monthly_sales_chart')
                @endcan
            </div>
        </div>
        @can('daily.sales.chart')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                @include('modules.general.dash.includes.ecommerce.daily_sales_chart')
            </div>
        </div>
        @endcan
        @can('daily.orders.chart')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                @include('modules.general.dash.includes.ecommerce.daily_orders_chart')
            </div>
        </div>
        @endcan
        <div class="row">
            @can('top.best.sellers')
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                @include('modules.general.dash.includes.ecommerce.top_best_sellers')
            </div>
            @endcan
            @can('top.product.category')
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                @include('modules.general.dash.includes.ecommerce.top_product_category')
            </div>
            @endcan
        </div>
        <div class="row">
            @can('top.product.brand')
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                @include('modules.general.dash.includes.ecommerce.top_product_brand')
            </div>
            @endcan
            @can('top.product.view')
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                @include('modules.general.dash.includes.ecommerce.top_products')
            </div>
            @endcan
        </div>
        <div class="row">
            @can('hourly.orders.chart')
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                @include('modules.general.dash.includes.ecommerce.hourly_orders_chart')
            </div>
            @endcan
            @can('payment.types.chart')
            <div class="col-sm-12 col-md-12 col-lg-4 col-xlg-4">
                @include('modules.general.dash.includes.ecommerce.payment_types_chart')
            </div>
            @endcan
            @can('currencies.chart')
            <div class="col-sm-12 col-md-12 col-lg-4 col-xlg-4">
                @include('modules.general.dash.includes.ecommerce.currencies_chart')
            </div>
            @endcan
        </div>
    </div>
    <!-- End Ecommerce Analytics -->

    <!-- Start Google Analytics -->
    @can('google.analytics')
    <div class="m-t-20 google-analytics-content" style="display: none;">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        @include('modules.general.dash.includes.analytics.analytics_info')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        @include('modules.general.dash.includes.analytics.website_visitors')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        @include('modules.general.dash.includes.analytics.website_page_view')
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        @include('modules.general.dash.includes.analytics.visitor_types')
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5 col-xlg-5">
                @include('modules.general.dash.includes.analytics.bounce_rate_chart')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                @include('modules.general.dash.includes.analytics.users_country', ['filter' => $current_year])
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                        @include('modules.general.dash.includes.analytics.top_reffers')
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                        @include('modules.general.dash.includes.analytics.top_browsers')
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                @include('modules.general.dash.includes.analytics.session_per_pages')
            </div>
        </div>
        <div class="row" style="display: none;">
            @can('cache.clear')
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <a href="{{ route('cache.clear') }}">
                    <div class="card bg-danger" style="min-height:162px;">
                        <div class="card-header">
                            <div class="card-title full-width">
                                CLICK TO CLEAR WEBSITE CACHE
                            </div>
                        </div>
                        <div class="card-body p-t-15">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2 hidden-1024">
                                    <img src="{{ asset('assets/img/cms-icons/general/cacheclear.svg') }}" alt="Clear Cache" width="65">
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10 full-width-1024">
                                    <p class="font-montserrat fs-18">
                                        - Website cache last cleared at: <br />{{ $last_cleared_at }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endcan
        </div>
    </div>
    @endcan
    <!-- End Google Analytics -->
</div>
@endsection
@include('modules.general.dash.asset')