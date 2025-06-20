<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Services\General\AnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Services\General\DashboardService;
use App\Services\General\EcommerceAnalyticsService;

class DashController extends Controller
{
    public function index(Request $req)
    {
        $dash = DashboardService::dashboardAnalytics($req);
        $last_cleared_at = cache()->remember('cache_last_cleared_at', config('app.addons_config.cache.24HR'), function () {
            return now()->format('Y-m-d H:i:s');
        });

        $weekly_diff = 0;
        $weekly_percent = 0;
        $monthly_diff = 0;
        $monthly_percent = 0;
        $yearly_diff = 0;
        $yearly_percent = 0;
        // $last_week_sales = $dash['last_week_total_sales'] != null ? $dash['last_week_total_sales'] : 0;
        // $weekly_diff = $last_week_sales - $dash['this_week_total_sales'];
        // if ($last_week_sales > 0) {
        //     $weekly_percent = (abs($weekly_diff) * 100) / $last_week_sales;
        // } else {
        //     $weekly_percent = 100;
        // }

        // $last_month_sales = $dash['last_month_total_sales'] != null ? $dash['last_month_total_sales'] : 0;
        // $monthly_diff = $last_month_sales - $dash['this_month_total_sales'];
        // if ($last_month_sales > 0) {
        //     $monthly_percent = (abs($monthly_diff) * 100) / $last_month_sales;
        // } else {
        //     $monthly_percent = 100;
        // }

        // $last_year_sales = $dash['last_year_total_sales'] != null ? $dash['last_year_total_sales'] : 0;
        // $yearly_diff = $last_year_sales - $dash['this_year_total_sales'];
        // if ($last_year_sales > 0) {
        //     $yearly_percent = (abs($yearly_diff) * 100) / $last_year_sales;
        // } else {
        //     $yearly_percent = 100;
        // }
        $completed_orders_percent = ($dash['total_orders'] > 0) ? (($dash['completed_orders'] / $dash['total_orders']) * 100) : 0;
        $unfinished_orders_percent = ($dash['total_orders'] > 0) ? (($dash['unfinished_orders'] / $dash['total_orders']) * 100) : 0;
        return view('modules.general.dash.index', [
            'url'               => rtrim(get_setting('website-domain'), '/'),
            'last_cleared_at'   => $last_cleared_at,
            'lastAnalysedAt'    => $dash['lastAnalysedAt'],
            'total_orders'  => $dash['total_orders'],
            'completed_orders'  => $dash['completed_orders'],
            'unfinished_orders'  => $dash['unfinished_orders'],
            'completed_orders_percent'  => $completed_orders_percent,
            'unfinished_orders_percent'  => $unfinished_orders_percent,
            'payment_type'  => $dash['payment_types'],
            'currencies'  => $dash['currencies'],
            'daily_orders'  => $dash['daily_orders'],
            'hourly_orders_count'  => $dash['today_hourly_orders']['count'],
            'hourly_orders_range'  => $dash['today_hourly_orders']['range'],
            'latest_orders'  => $dash['latest_orders'],
            'country_wise_orders'  => $dash['country_wise_orders'],
            'top_product_views'  => $dash['top_product_views'],
            'most_visited_pages'  => $dash['most_visited_pages'],
            'users_country'  => $dash['users_country'],
            'top_refferers'      => $dash['top_refferers'],
            'top_browsers'       => $dash['top_browsers'],
            'top_best_sellers'       => $dash['top_best_sellers'],
            'top_product_category'       => $dash['top_product_category'],
            'top_product_brand'       => $dash['top_product_brand'],
            'bounce_rate'        => $dash['bounce_rate'],
            'session_durations'  => $dash['session_durations'],
            'user_types'         => $dash['user_types'],
            'yesterday_total_visitors_and_page_views'  => $dash['yesterday_total_visitors_and_page_views'],
            'last7Days_total_visitors_and_page_views'  => $dash['last7Days_total_visitors_and_page_views'],
            'last30Days_total_visitors_and_page_views' => $dash['last30Days_total_visitors_and_page_views'],
            'total_transactions' => $dash['total_transactions'],
            'customers' => $dash['customers'],
            'conversion_rate' => $dash['conversion_rate'],
            'this_week_daily_sales' => $dash['this_week_daily_sales'],
            'monthly_sales' => $dash['monthly_sales'],
            'daily_sales' => $dash['daily_sales'],
            'this_week_total_sales' => $dash['this_week_total_sales'],
            'last_week_total_sales' => $dash['last_week_total_sales'],
            'this_month_total_sales' => $dash['this_month_total_sales'],
            'last_month_total_sales' => $dash['last_month_total_sales'],
            'this_year_total_sales' => $dash['this_year_total_sales'],
            'last_year_total_sales' => $dash['last_year_total_sales'],
            'total_sales'           => $dash['total_sales'],
            'weekly_diff'           => $weekly_diff,
            'monthly_diff'           => $monthly_diff,
            'yearly_diff'           => $yearly_diff,
            'weekly_percent'           => $weekly_percent,
            'monthly_percent'           => $monthly_percent,
            'yearly_percent'           => $yearly_percent,
            'replace_title'             => 'OODNI | '
        ]);
    }

    public function monthly_sales(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $data = EcommerceAnalyticsService::_monthly_sales($request);
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function bounce_rate(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $data = AnalyticsService::_bounce_rate($request);
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function order_by_day(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $data = EcommerceAnalyticsService::_order_by_day($request);
        return response()->json(['status' => true, 'data' => $data['data'], 'year' => $data['year']]);
    }

    public function daily_sales(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $data = EcommerceAnalyticsService::_daily_sales($request);
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function users_by_country(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $users_country = AnalyticsService::_users_by_country($request);
        return response()->json(['status' => true, 'users_country' => $users_country]);
    }

    public function refresh()
    {
        DashboardService::refreshDashboardAnalytics();
        return back()->with('info', 'Dashboard information has been refreshed.');
    }

    public function welcome()
    {
        return view('modules.general.dash.welcome');
    }

    public function help()
    {
        return view('modules.general.dash.help');
    }

    public function cache_clear()
    {
        cache()->flush();
        Storage::deleteDirectory(config('app.config.image_cache.CACHE_PATH'));
        return back()->with('success', 'Website cache has been cleared.');
    }
}