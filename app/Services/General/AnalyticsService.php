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
use App\Models\Ecommerce\OrderShippingAddress;
use App\Services\Ecommerce\ReportService;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Google\Service\Monitoring\Custom;
use Spatie\Analytics\Period;

class AnalyticsService
{

    public static function _most_visited_pages()
    {
        return cache()->remember('cache_MostVisitedPages', config('app.config.cache.24HR'), function () {
            return Analytics::fetchMostVisitedPages(Period::days(30), 10);
        });
    }
    public static function _top_refferers()
    {
        return cache()->remember('cache_TopReferrers', config('app.config.cache.24HR'), function () {
            return Analytics::fetchTopReferrers(Period::days(30), 10);
        });
    }
    public static function _top_browsers()
    {
        return cache()->remember('cache_TopBrowsers', config('app.config.cache.24HR'), function () {
            return Analytics::fetchTopBrowsers(Period::days(30), 10);
        });
    }
    public static function _till_date_total_visitors_and_page_views()
    {
        return cache()->remember('cache_TillDateTotalVisitorsAndPageViews', config('app.config.cache.24HR'), function () {
            $total_visitors = 0;
            $total_page_views = 0;
            $previous_date = \Carbon\Carbon::createFromFormat('Y-m-d', '2021-10-20');
            $today = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
            $data = $today->diff($previous_date);
            $days = $data->days;
            $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days($days));
            foreach ($fetchTotalVisitorsAndPageViews as $month) {
                $total_visitors += $month['visitors'];
                $total_page_views += $month['pageViews'];
            }
            return [
                'total_visitors' => $total_visitors,
                'total_page_views' => $total_page_views
            ];
        });
    }

    public static function _last30Days_total_visitors_and_page_views()
    {
        return cache()->remember('cache_Last30DaysTotalVisitorsAndPageViews', config('app.config.cache.24HR'), function () {
            $total_visitors = 0;
            $total_page_views = 0;
            $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(30));
            foreach ($fetchTotalVisitorsAndPageViews as $month) {
                $total_visitors += $month['visitors'];
                $total_page_views += $month['pageViews'];
            }
            return [
                'total_visitors' => $total_visitors,
                'total_page_views' => $total_page_views
            ];
        });
    }

    public static function _yesterday_total_visitors_and_page_views()
    {
        return cache()->remember('cache_YesterdayTotalVisitorsAndPageViews', config('app.config.cache.24HR'), function () {
            $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(1));
            return [
                'total_visitors' => isset($fetchTotalVisitorsAndPageViews[0]) ? $fetchTotalVisitorsAndPageViews[0]['visitors'] : 0,
                'total_page_views' => isset($fetchTotalVisitorsAndPageViews[0]) ? $fetchTotalVisitorsAndPageViews[0]['pageViews'] : 0
            ];
        });
    }

    public static function _last7Days_total_visitors_and_page_views()
    {
        return cache()->remember('cache_Last7DaysTotalVisitorsAndPageViews', config('app.config.cache.24HR'), function () {
            $total_visitors = 0;
            $total_page_views = 0;
            $analyticsData3 = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
            foreach ($analyticsData3 as $week) {
                $total_visitors += $week['visitors'];
                $total_page_views += $week['pageViews'];
            }
            return [
                'total_visitors' => $total_visitors,
                'total_page_views' => $total_page_views
            ];
        });
    }

    public static function _users_types()
    {
        return cache()->remember('cache_UserTypes', config('app.config.cache.24HR'), function () {
            $user_types = [];
            $fetchUserTypes = Analytics::fetchUserTypes(Period::days(30));
            foreach ($fetchUserTypes as $user_type) {
                $user_types[$user_type['type']] = $user_type['sessions'];
            }
            return $user_types;
        });
    }
    public static function _session_durations()
    {
        return cache()->remember('cache_sessionDurations', config('app.config.cache.24HR'), function () {
            $fetchSessionDuration = Analytics::performQuery(
                Period::days(30),
                'ga:sessionDuration',
                [
                    'metrics' => 'ga:pageviews, ga:sessions, ga:sessionDuration',
                    'dimensions' => 'ga:pagePath, ga:pageTitle'
                ]
            );
            $data = [];
            foreach ($fetchSessionDuration as $key => $row) {
                $data[$key] = [
                    'path' => $row[0],
                    'title' => $row[1],
                    'pageviews' => $row[2],
                    'sessions' => $row[3],
                    'sessionDuration' => $row[4],
                ];
            }
            return $data;
        });
    }
    public static function _users_by_country($req)
    {
        if ($req->has('filter') && $req->filter != null && $req->filter != "overall") {
            $start = Carbon::parse($req->filter)->startOfYear();
            $end = Carbon::parse($req->filter)->endOfYear();
        } elseif ($req->has('filter') && $req->filter != null && $req->filter == "overall") {
            $start = Carbon::parse(config('app.config.start_year') . '-01')->startOfYear();
            $end = Carbon::now()->endofYear();
        } else {
            $start = Carbon::now()->startofYear();
            $end = Carbon::now()->endofYear();
        }
        return cache()->remember('cache_UsersByCountry_'. $start, config('app.config.cache.24HR'), function () use($start, $end) {
            $location_analytics = Analytics::performQuery(
                Period::create($start, $end),
                'ga:users, ga:pageviews',
                [
                    'metrics' => 'ga:users, ga:pageviews',
                    'dimensions' => 'ga:countryIsoCode, ga:country'
                ]
            );
            $analytics_data = [];
            if ($location_analytics->rows != null) {
                $i = 0;
                foreach ($location_analytics->rows as $row) {
                    $analytics_data[$i]['id']    = $row[0];
                    $analytics_data[$i]['name']  = $row[1];
                    $analytics_data[$i]['users'] = $row[2];
                    $analytics_data[$i]['views'] = $row[3];
                    $analytics_data[$i]['fill'] = ($row[3] > 100) ? "#F05C5C" : "#5C5CFF";
                    
                    $i++;
                }
            }
            $keys = array_column($analytics_data, 'views');
            array_multisort($keys, SORT_DESC, $analytics_data);
            return $analytics_data;
        });
    }
    public static function _bounce_rate($req)
    {
        if ($req->has('filter') && $req->filter != null) {
            $start = Carbon::parse($req->filter)->startOfYear();
            $end = Carbon::parse($req->filter)->endOfYear();
        }else{
            $start = Carbon::now()->startofYear();
            $end = Carbon::now()->endofYear();
        }
        return cache()->remember('cache_bounceRate_' . $start, config('app.config.cache.24HR'), function () use($start, $end) {
            $fetchBounceRate = Analytics::performQuery(
                Period::create($start, $end),
                'ga:bounceRate',
                [
                    'metrics' => 'ga:bounceRate',
                    'dimensions' => 'ga:month'
                ]
            );
            $data = [];
            $label = [];
            $average_bounce_rate = $fetchBounceRate['totalsForAllResults']['ga:bounceRate'];
            $year = Carbon::parse($start)->format('Y');
            foreach ($fetchBounceRate as $row) {
                $month = $row[0];
                $data[] = number_format($row[1], 0, '', ',');
                $date = $year.'-'.$month;
                $label[] = Carbon::parse($date)->format('M');
            }
            return [
                'data' => $data,
                'label' => $label,
                'average_bounce_rate' => $average_bounce_rate,
                'year' => $year,
            ];
        });
    }
}
