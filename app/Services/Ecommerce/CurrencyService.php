<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Currency;

class CurrencyService
{
    public static function _find($uuid)
    {
        return Currency::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Currency::orderBy('created_at', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Currency::with(['exchangeRate', 'user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('currency', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new Currency();
        $model->currency = $req->currency;
        $model->is_active = $req->has('is_active') ? 10 : 0;
        
        return $model->save() ? $model->uuid : false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->currency = $req->currency;
        $model->is_active = $req->has('is_active') ? 10 : 0;

        return $model->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        return $model->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return -1;

        $model->is_active = ($model->is_active == 10 ? 0 : 10);
        $model->update();
        return $model->is_active;
    }
}