<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\ExchangeRate;

class ExchangeRateService
{
    public static function _find($currencyId)
    {
        return ExchangeRate::where('currency_id', $currencyId)->where('is_active', 10)->orderBy('created_at', 'DESC')->first();
    }

    public static function _get()
    {
        return ExchangeRate::where('currency_id', $currency->id)->orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req, $currencyId)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $data = ExchangeRate::where('currency_id', $currencyId)->orderBy('created_at', 'DESC');
        return $data->paginate($per_page);
    }

    public static function _updating($req, $currencyId)
    {
        $model = ExchangeRate::where('currency_id', $currencyId)->where('is_active', 10)->first();
        if ($model) {
            $model->is_active = 0;
            if ($model->update()) {
                return self::_storing($currencyId, $req);
            }
        } else {
            return self::_storing($currencyId, $req);
        }
    }

    public static function _storing($currencyId, $req)
    {
        $model = new ExchangeRate();
        $model->rate        = $req->rate;
        $model->currency_id  = $currencyId;
        $model->is_active   = 10;

        return $model->save() ? true : false;
    }
}
