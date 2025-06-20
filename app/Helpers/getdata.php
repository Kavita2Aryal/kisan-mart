<?php

use App\Models\Ecommerce\ExchangeRate;
use App\Models\General\SparrowSms;
use App\Services\General\SettingService;
use App\Services\Build\ListGroupService;
use App\Services\Build\SectionConfigBuildService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getStatic')) {

    function getStatic($file)
    {
        return App::environment('local') ? asset("$file") : url("/$file");
    }
}

if (!function_exists('indexing')) {
 
    function indexing()
    {
        return 'index_' . rand(0, 99999) . '_' . rand(0, 99999);
    }
}

if (!function_exists('get_setting')) {
 
    function get_setting($slug)
    {
        return SettingService::_get_data($slug);
    }
}

if (!function_exists('get_list_group')) {
 
    function get_list_group($slug)
    {
        return ListGroupService::_get_data($slug);
    }
}

if (!function_exists('get_section_config')) {
 
    function get_section_config()
    {
        return SectionConfigBuildService::_get_data();
    }
}

if (!function_exists('trim_description')) {
 
    function trim_description($desc)
    {
        return (substr(trim($desc), -11) == '<p><br></p>') ? substr(trim($desc), 0, -11) : $desc;
    }
}

if (!function_exists('get_hit')) {

    function get_hit($type)
    {
        return Storage::exists('public/' . $type . '.txt') ? Storage::get('public/' . $type . '.txt') : false;
    }
}

if (!function_exists('send_sms')) {

    function send_sms($user, $msg)
    {
        return true; //remove later
        $params = [
            'msg' => $msg,
            'to'  => $user // or just one mobile number
        ];

        $sms = new SparrowSms();
        $response = $sms->_send($params);
        return $response;
    }
}

if (!function_exists('get_currency')) {

    function get_currency()
    {
        return cache()->remember('cache_Currency', config('app.config.cache.24HR'), function () {
            $exchange_rate = ExchangeRate::select('currencies.currency', 'exchange_rates.id')
                            ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
                            ->where('currencies.is_active', 10)
                            ->where('exchange_rates.is_active', 10)
                            ->get()->toArray();
            return $currencies = array_column($exchange_rate, 'currency', 'id');
        });
    }
}

if (!function_exists('get_pricing')) {
    function get_offer_price($selling_price, $offer)
    {
        $currency = get_currency();

        $current_price = 0.00;
        $has_offer = false;
        $today = Carbon::now()->format('Y-m-d H:i:s');
        if ($offer != null && count($offer) > 0 && $offer['start_date'] <= $today) {
            if($offer['end_date'] != null){
                $has_offer = ($offer['end_date'] >= $today) ? true : false;
            }
            $has_offer = true;
        }
        if($has_offer){
            $discount_type = $offer['discount_type'];
            $discount = $offer['discount'];
            if ($discount_type == 1) {
                $current_price = ($selling_price * (1 - ($discount / 100)));
                $discount_rate = $discount;
            } else {
                $current_price = $selling_price - $discount;
                $discount_amount = $discount;
            }
        }
        return $current_price;
    }
}

if (!function_exists('route_is')) {

    function route_is($route)
    {
        $data = request()->routeIs($route);
        return $data;
    }
}
