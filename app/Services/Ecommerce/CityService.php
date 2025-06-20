<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\City;

class CityService
{
    public static function _find($uuid)
    {
        return City::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return City::orderBy('name', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = City::with(['region', 'user'])->orderBy('name', 'ASC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new City();
        $model->name       = $req->name;
        $model->region_id  = $req->region_id;
        $model->is_active  = $req->has('is_active') ? 10 : 0;
        
        return $model->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->name      = $req->name;
        $model->region_id = $req->region_id;
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