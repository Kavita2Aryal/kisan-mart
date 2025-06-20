<?php

namespace App\Services\General;

use App\Services\Ecommerce\ReportService;

use App\Services\General\AnalyticsService;
use App\Services\General\EcommerceAnalyticsService;


class DashboardService
{
    public static function dashboardAnalytics($req)
    {
        $sales = EcommerceAnalyticsService::_sales();
        $total_transactions = EcommerceAnalyticsService::_total_transaction();
        $till_date_total_visitors_and_page_views = AnalyticsService::_till_date_total_visitors_and_page_views();
        $conversion_rate = ($total_transactions / $till_date_total_visitors_and_page_views['total_visitors']) * 100;
        return [
            'total_orders' => EcommerceAnalyticsService::_order_count('all'),
            'completed_orders' => EcommerceAnalyticsService::_order_count('completed'),
            'unfinished_orders' => EcommerceAnalyticsService::_order_count('unfinished'),
            'payment_types' => EcommerceAnalyticsService::_payment_types(),
            'currencies' => EcommerceAnalyticsService::_currency_types(),
            'today_hourly_orders' => EcommerceAnalyticsService::_order_by_hour(),
            'country_wise_orders' => EcommerceAnalyticsService::_order_by_country(),
            'daily_orders' => EcommerceAnalyticsService::_order_by_day($req),
            'total_transactions' => $total_transactions,
            'latest_orders' => EcommerceAnalyticsService::_get_latest_orders(),
            'customers' => EcommerceAnalyticsService::_repeated_customer(),
            'top_product_views' => EcommerceAnalyticsService::_top_product_views(),
            'most_visited_pages' => AnalyticsService::_most_visited_pages(),
            'users_country' => AnalyticsService::_users_by_country($req),
            'top_refferers' => AnalyticsService::_top_refferers(),
            'top_browsers' => AnalyticsService::_top_browsers(),
            'top_best_sellers' => EcommerceAnalyticsService::_top_best_sellers(),
            'top_product_category' => EcommerceAnalyticsService::_top_product_category(),
            'top_product_brand' => EcommerceAnalyticsService::_top_product_brand(),
            'bounce_rate' => AnalyticsService::_bounce_rate($req),
            'session_durations' => AnalyticsService::_session_durations(),
            'yesterday_total_visitors_and_page_views' => AnalyticsService::_yesterday_total_visitors_and_page_views(),
            'last7Days_total_visitors_and_page_views' => AnalyticsService::_last7Days_total_visitors_and_page_views(),
            'last30Days_total_visitors_and_page_views' => AnalyticsService::_last30Days_total_visitors_and_page_views(),
            'till_date_total_visitors_and_page_views' => $till_date_total_visitors_and_page_views,
            'conversion_rate' => $conversion_rate,
            'user_types' => AnalyticsService::_users_types(),
            'this_week_daily_sales' => $sales['this_week_daily_sales'],
            'monthly_sales' => EcommerceAnalyticsService::_monthly_sales($req),
            'daily_sales' => EcommerceAnalyticsService::_daily_sales($req),
            'this_week_total_sales' => $sales['this_week_total_sales'],
            'last_week_total_sales' => $sales['last_week_total_sales'],
            'this_month_total_sales' => $sales['this_month_total_sales'],
            'last_month_total_sales' => $sales['last_month_total_sales'],
            'this_year_total_sales' => $sales['this_year_total_sales'],
            'last_year_total_sales' => $sales['last_year_total_sales'],
            'total_sales'           => $sales['total_sales'],
            'lastAnalysedAt' => cache()->remember('cache_LastAnalysedAt', config('app.config.cache.24HR'), function () {
                return now()->format('Y-m-d H:i:s');
            }),
        ];
    }
    public static function refreshDashboardAnalytics()
    {
        cache()->flush();
    }
}
