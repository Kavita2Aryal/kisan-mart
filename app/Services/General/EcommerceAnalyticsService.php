<?php

namespace App\Services\General;

use Analytics;
use App\Models\Ecommerce\Customer;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Product\Product;
use App\Models\General\User;
use App\Models\Cms\ImageX;
use App\Models\Cms\Page\Page;
use App\Models\Addons\Testimonial;
use App\Models\Addons\Blog\Blog;
use App\Models\Ecommerce\ExchangeRate;
use App\Models\Ecommerce\OrderShippingAddress;
use App\Services\Ecommerce\ReportService;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Spatie\Analytics\Period;

class EcommerceAnalyticsService
{

    public static function _top_best_sellers()
    {
        return cache()->remember('cache_TopBestSellers', config('app.config.cache.24HR'), function () {
            return ReportService::_best_seller('top_result');
        });
    }

    public static function _top_product_category()
    {
        return cache()->remember('cache_TopProductCategory', config('app.config.cache.24HR'), function () {
            return ReportService::_product_category('top_result');
        });
    }

    public static function _top_product_brand()
    {
        return cache()->remember('cache_TopProductBrand', config('app.config.cache.24HR'), function () {
            return ReportService::_product_brand('top_result');
        });
    }

    public static function _top_product_views()
    {
        return cache()->remember('cache_topProductViews', config('app.config.cache.24HR'), function () {
            $start = Carbon::parse(now()->subMonth(1)->format('Y-m-d')); //last 3 months
            $end = Carbon::parse(now()->format('Y-m-d'));
            return Analytics::performQuery(
                Period::create($start, $end),
                'ga:pageViews',
                [
                    'dimensions' => 'ga:pagePath,ga:pageTitle',
                    'metrics' => 'ga:pageviews',
                    'sort' => '-ga:pageviews',
                    'max-results' => 10,
                    'filters' => 'ga:pagePath=~/p/'
                ]
            );
        });
    }

    public static function _payment_types()
    {
        return cache()->remember('cache_PaymentTypes', config('app.config.cache.24HR'), function () {
            $config_payment_type = get_list_group('payment_type');
            $order_data = Order::select('payment_type')->selectRaw('count(id) as count')->whereNotNull('payment_type')->groupBy('payment_type')->get()->keyBy('payment_type')->toArray();
            if($config_payment_type != null) {
                //array_merge_according_to_key
                $order = [];
                if ($order_data) {
                    foreach ($order_data as $key => $row) {
                        $payment_type = $config_payment_type[$key];
                        $order[$payment_type] = $row['count'];
                    }
                }
    
                $final = [];
                foreach ($config_payment_type as $c_row) {
                    if (array_key_exists($c_row, $order)) {
                        $final[] = $order[$c_row];
                    } else {
                        $final[] = 0;
                    }
                }
                return [
                    'data' => $final, 
                    'payment_type_group' => array_values($config_payment_type)
                ];
            }
        });
    }

    public static function _currency_types()
    {
        return cache()->remember('cache_CurrencyWithRate', config('app.config.cache.24HR'), function () {
            $currencies = get_currency();
            $orders = Order::select('exchange_rate_id', DB::raw('COUNT(id) as count'))
                    ->orderBy('created_at', 'ASC')->groupBy('exchange_rate_id')->get()->keyBy('exchange_rate_id')->toArray();
            $data = [];
            $currency = [];
            foreach($currencies as $key => $row)
            {
                $currency[] = $row;
                $data[] = $orders[$key]['count'] ?? 0;
            }

            return [
                'data' => $data,
                'currency' => $currency
            ];
        });
    }

    public static function _order_count($type)
    {
        return cache()->remember('cache_OrderCount_' . $type, config('app.config.cache.24HR'), function () use ($type) {
            if ($type == "all") {
                $orders = Order::count();
            } elseif ($type == "completed") {
                $status = get_list_group('order-status-save')['delivered'];
                $orders = Order::where('current_status', $status)->count();
            } else {
                $status = get_list_group('order-status-save')['delivered'];
                $orders = Order::where('current_status', '!=', $status)->count();
            }
            return $orders;
        });
    }

    public static function _monthly_sales($req)
    {
        if ($req->has('filter') && $req->filter != null) {
            $start = Carbon::parse($req->filter)->startOfYear();
            $end = Carbon::parse($req->filter)->endOfYear();
        } else {
            $end = Carbon::now()->endofYear();
            $start = Carbon::now()->startofYear();
        }
        return cache()->remember('cache_MonthlySales_'. $start, config('app.config.cache.24HR'), function () use ($start, $end) {
            $order_status = get_list_group('order-status-save');
            $cancelled_status = $order_status['cancelled'];
            $pending_status   = $order_status['pending'];
            $monthly_orders = Order::select('orders.total', DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m") as group_month'), 'currencies.currency as currency')
                                ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                ->where('current_status', '!=', $cancelled_status)
                                ->where('current_status', '!=', $pending_status)
                                ->whereBetween('orders.created_at', [$start, $end])
                                ->orderBy('orders.created_at', 'ASC')->get()->groupBy(['currency', 'group_month']);

            $db_monthly_sales = self::_calculate_amount_with_period_currency($monthly_orders);
            $monthly_sales = [];
            $monthly_range = [];

            $period = new DatePeriod($start, new DateInterval('P1M'), $end);

            $currencies = get_currency();
            foreach ($period as $date) {
                $yearMonth = Carbon::parse($date)->format('Y-m');
                $month = Carbon::parse($date)->format('M');
                $monthly_range[] = $month;
                // foreach($monthly_orders as $key => $row){
                //     $monthly_sales[$currencies[$key]][$month] = isset($db_monthly_sales[$key][$yearMonth]) ? $db_monthly_sales[$key][$yearMonth]['total_amount'] : 0;
                // }
                foreach($currencies as $key => $row){
                    $monthly_sales[$row][$month] = $db_monthly_sales[$row][$yearMonth]['total_amount'] ?? 0;
                }
                
            }
            return $data = [
                'monthly_range'           => $monthly_range,
                'monthly_sales'           => $monthly_sales,
                'year'                    => Carbon::parse($start)->format('Y'),
            ];
        });
    }

    public static function _daily_sales($req)
    {
        if ($req->has('start') && $req->start != null && $req->has('end') && $req->end != null) {
            $start = Carbon::parse($req->start)->startOfDay();
            $end = Carbon::parse($req->end)->endofDay();
        } else {
            $end = Carbon::now()->endOfDay();
            $start = Carbon::parse($end)->startOfDay()->modify('-29 days');
        }

        return cache()->remember('cache_DailySales_' . $start . '_' . $end, config('app.config.cache.24HR'), function () use ($start, $end) {
            $order_status = get_list_group('order-status-save');
            $cancelled_status = $order_status['cancelled'];
            $pending_status   = $order_status['pending'];
            // last 30 days
            $daily_orders = Order::select('orders.total', DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m-%d") as group_day'), 'currencies.currency as currency')
                            ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                            ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                            ->where('current_status', '!=', $cancelled_status)
                            ->where('current_status', '!=', $pending_status)
                            ->whereBetween('orders.created_at', [$start, $end])
                            ->orderBy('orders.created_at', 'ASC')->get()->groupBy(['currency', 'group_day']);

            $db_daily_sales = self::_calculate_amount_with_period_currency($daily_orders);

            $daily_sales = [];
            $daily_sales_range = [];
            $period = new DatePeriod($start, new DateInterval('P1D'), $end);

            $currencies = get_currency();

            foreach ($period as $date) {
                $full_date = Carbon::parse($date)->format('Y-m-d');
                $monthDay = Carbon::parse($date)->format('M d');
                $daily_sales_range[] = $monthDay;
                foreach($currencies as $key => $row){
                    $daily_sales[$row][$monthDay] = $db_daily_sales[$row][$full_date]['total_amount'] ?? 0;
                }
            }
            return $data = [
                'daily_sales_range' => $daily_sales_range,
                'daily_sales'       => $daily_sales,
                'start_year'        => Carbon::parse($start)->format('Y'),
                'end_year'          => Carbon::parse($end)->format('Y'),
            ];
        });
    }

    public static function _order_by_day($req)
    {
        // $end = Carbon::now()->endOfDay();
        // $start = Carbon::parse($end)->startOfDay()->modify('-11 months');
        if ($req->has('filter') && $req->filter != null) {
            $start = Carbon::parse($req->filter)->startOfYear();
            $end = Carbon::parse($req->filter)->endOfYear();
        } else {
            $end = Carbon::now()->endofYear();
            $start = Carbon::now()->startofYear();
        }
        return cache()->remember('cache_OrderByDay_' . $start, config('app.config.cache.24HR'), function () use ($start, $end) {
            $daily_orders = Order::select(DB::raw('COUNT(id) as count'), DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'))
                ->whereBetween('created_at', [$start, $end])
                ->orderBy('created_at', 'ASC')->groupBy('day')->get()->keyBy('day')->toArray();
            $daily_order_count = [];

            $period = new DatePeriod($start, new DateInterval('P1D'), $end);
            foreach ($period as $date) {
                $full_date = Carbon::parse($date)->format('Y-m-d');
                $daily_order_count[] = [
                    'date' => $full_date,
                    'value' => isset($daily_orders[$full_date]) ? $daily_orders[$full_date]['count'] : 0
                ];
            }
            return [
                'data' => $daily_order_count, 
                'year' => Carbon::parse($start)->format('Y')
            ];
        });
    }

    public static function _order_by_hour()
    {
        return cache()->remember('cache_OrderByHour', config('app.config.cache.24HR'), function () {
            $start = Carbon::now()->startOfDay();
            $end = Carbon::now()->endOfDay();

            $hourly_orders = Order::select(DB::raw('COUNT(id) as count'), DB::raw('DATE_FORMAT(created_at, "%H") as hour'))
                ->orderBy('created_at', 'ASC')->groupBy('hour')->get()->keyBy('hour')->toArray();

            $hourly_order_count = [];
            $range = [];

            $period = new DatePeriod($start, new DateInterval('PT1H'), $end);
            foreach ($period as $date) {
                $hour = Carbon::parse($date)->format('H');
                $hour_range = Carbon::parse($date)->format('g A');
                $range[] = $hour_range;
                $hourly_order_count[] = isset($hourly_orders[$hour]) ? $hourly_orders[$hour]['count'] : 0;
            }
            return [
                'range'       => $range,
                'count'     => $hourly_order_count,
            ];
        });
    }

    public static function _order_by_country()
    {
        return cache()->remember('cache_OrderByCountry', config('app.config.cache.24HR'), function () {
            $domestic_orders = OrderShippingAddress::where('country', 1)->count();
            $international_orders = OrderShippingAddress::where('country', '!=', 1)->orWhere('country', null)->count();

            return [
                'domestic_orders' => $domestic_orders,
                'international_orders' => $international_orders
            ];
        });
    }

    public static function _get_latest_orders()
    {
        return cache()->remember('cache_LatestOrders', config('app.config.cache.24HR'), function () {
            $status = get_list_group('order-status-save')['pending'];
            $data = Order::with('exchangeRate.currency', 'customer')
                ->select(['orders.id', 'orders.order_code', 'orders.customer_id', 'orders.sub_total', 'orders.discount_amount', 'orders.delivery_charge', 'orders.vat_amount', 'orders.total', 'orders.created_at', 'orders.uuid', 'orders.exchange_rate_id', 'order_status.created_at as status_created_at', 'orders.payment_type'])
                ->join('order_status', function ($join) use ($status) {
                    $join->on('orders.id', '=', 'order_status.order_id');
                    $join->where('order_status.status', '=', $status);
                    $join->where('order_status.is_active', '=', 10);
                })->orderBy('orders.created_at', 'DESC')->take(10)->get();
            return $data;
        });
    }

    public static function _sales()
    {
        return cache()->remember('cache_Sales'. time(), config('app.config.cache.24HR'), function () {
            $order_status = get_list_group('order-status-save');
            $cancelled_status = $order_status['cancelled'];
            $pending_status   = $order_status['pending'];
            $currencies = get_currency();

            $this_week_daily_orders = Order::select('orders.total', DB::raw('DATE_FORMAT(orders.created_at, "%w") as group_day'), 'currencies.currency as currency')
                                    ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                    ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                    ->where('current_status', '!=', $cancelled_status)
                                    ->where('current_status', '!=', $pending_status)
                                    ->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek()])
                                    ->orderBy('orders.created_at', 'ASC')->get()->groupBy(['currency', 'group_day']);

            $db_this_week_daily_sales = self::_calculate_amount_with_period_currency($this_week_daily_orders);
            $this_week_daily_sales = [];
            for ($i = 0; $i <= 6; $i++) {
                foreach($currencies as $key => $row){
                    // $this_week_daily_sales[] = isset($db_this_week_daily_sales[$i]) ? $db_this_week_daily_sales[$i]['total_amount'] : 0;
                    $this_week_daily_sales[$row][] = $db_this_week_daily_sales[$row][$i]['total_amount'] ?? 0;
                }
            }
            $this_week_total_orders  = Order::select('orders.total', 'currencies.currency as currency')
                                        ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                        ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                        ->where('current_status', '!=', $cancelled_status)
                                        ->where('current_status', '!=', $pending_status)
                                        ->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek()])
                                        ->orderBy('orders.created_at', 'ASC')->get()->groupBy('currency');

            $this_week_total_sales = self::_calculate_amount_with_currency($this_week_total_orders, $currencies);

            $last_week_total_orders  = Order::select('orders.total', 'currencies.currency as currency')
                                        ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                        ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                        ->where('current_status', '!=', $cancelled_status)
                                        ->where('current_status', '!=', $pending_status)
                                        ->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
                                        ->orderBy('orders.created_at', 'ASC')->get()->groupBy('currency');

            $last_week_total_sales = self::_calculate_amount_with_currency($last_week_total_orders, $currencies);

            $this_month_total_orders  = Order::select('orders.total', 'currencies.currency as currency')
                                        ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                        ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                        ->where('current_status', '!=', $cancelled_status)
                                        ->where('current_status', '!=', $pending_status)
                                        ->whereBetween('orders.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                                        ->orderBy('orders.created_at', 'ASC')->get()->groupBy('currency');        

            $this_month_total_sales = self::_calculate_amount_with_currency($this_month_total_orders, $currencies);

            $last_month_total_orders  = Order::select('orders.total', 'currencies.currency as currency')
                                        ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                        ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                        ->where('current_status', '!=', $cancelled_status)
                                        ->where('current_status', '!=', $pending_status)
                                        ->whereBetween('orders.created_at', [Carbon::now()->startOfMonth()->subMonth(), Carbon::now()->endOfMonth()->subMonth()])
                                        ->orderBy('orders.created_at', 'ASC')->get()->groupBy('currency');

            $last_month_total_sales = self::_calculate_amount_with_currency($last_month_total_orders, $currencies);

            $this_year_total_orders  = Order::select('orders.total', 'currencies.currency as currency')
                                        ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                        ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                        ->where('current_status', '!=', $cancelled_status)
                                        ->where('current_status', '!=', $pending_status)
                                        ->whereBetween('orders.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                                        ->orderBy('orders.created_at', 'ASC')->get()->groupBy('currency');

            $this_year_total_sales = self::_calculate_amount_with_currency($this_year_total_orders, $currencies);

            $last_year_total_orders  = Order::select('orders.total', 'currencies.currency as currency')
                                        ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                                        ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                                        ->where('current_status', '!=', $cancelled_status)
                                        ->where('current_status', '!=', $pending_status)
                                        ->whereBetween('orders.created_at', [Carbon::now()->startOfYear()->subYear(), Carbon::now()->endOfYear()->subYear()])
                                        ->orderBy('orders.created_at', 'ASC')->get()->groupBy('currency');

            $last_year_total_sales = self::_calculate_amount_with_currency($last_year_total_orders, $currencies);

            $total_orders  = Order::select('orders.total', 'currencies.currency as currency')
                            ->join('exchange_rates', 'exchange_rates.id', '=', 'orders.exchange_rate_id')
                            ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                            ->where('current_status', '!=', $cancelled_status)
                            ->where('current_status', '!=', $pending_status)
                            ->orderBy('orders.created_at', 'ASC')->get()->groupBy('currency');

            $total_sales = self::_calculate_amount_with_currency($total_orders, $currencies);
            return [
                'this_week_daily_sales'     => $this_week_daily_sales,
                'this_week_total_sales'     => $this_week_total_sales,
                'last_week_total_sales'     => $last_week_total_sales,
                'this_month_total_sales'    => $this_month_total_sales,
                'last_month_total_sales'    => $last_month_total_sales,
                'this_year_total_sales'     => $this_year_total_sales,
                'last_year_total_sales'     => $last_year_total_sales,
                'total_sales'               => $total_sales
            ];
        });
    }

    public static function _calculate_amount_with_period_currency($orders)
    {
        $data = [];
        foreach ($orders as $key => $order_lists) {
            foreach($order_lists as $r_key => $row){
                $g_total = self::_get_total_amount($row);
                $data[$key][$r_key] = [
                    'group_day' => $r_key,
                    'total_amount' => $g_total,
                ];
            }
        }
        return $data;
    }

    public static function _calculate_amount_with_currency($orders, $currencies)
    {
        $data = [];
        $result = [];
        foreach ($orders as $key => $order_lists) {
            $g_total = self::_get_total_amount($order_lists);
            $data[$key] =  $g_total;
        }

        foreach($currencies as $key => $row)
        {
            $result[$row] = $data[$row] ?? 0;
        }
        return $result;
    }

    public static function _get_total_amount($orders)
    {
        $g_total = 0;
        foreach ($orders as $row) {
            $total = $row->total;
            $g_total += $total;
        }
        return $g_total;
    }

    public static function _repeated_customer()
    {
        return cache()->remember('cache_Customers', config('app.config.cache.24HR'), function () {
            $data = Customer::withCount('orders')->where('is_active', 10)->get()->toArray();
            $customers = array_column($data, 'orders_count');
            $count = 0;
            foreach ($customers as $value) {
                if ($value > 1) {
                    $count++;
                }
            }
            return [
                'total_customers' => count($data),
                'repeated_customers' => $count
            ];
        });
    }

    public static function _total_transaction()
    {
        return cache()->remember('cache_TotalTransactions', config('app.config.cache.24HR'), function () {
            $order = Order::count();
            return $order;
        });
    }
}
