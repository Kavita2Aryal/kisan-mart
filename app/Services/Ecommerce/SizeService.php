<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Size;
use Illuminate\Support\Str;

class SizeService
{
    public static function _find($uuid)
    {
        return Size::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Size::where('is_active', 10)->orderBy('created_at', 'DESC')->get()->map->_format();
    }

    public static function _paging($req)
    {

        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Size::orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('value', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new Size();
        $model->value               = strtolower($req->value);
        $model->is_active           = $req->has('is_active') ? 10 : 0;
        
        return $model->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->value               = strtolower($req->value);
        $model->is_active           = $req->has('is_active') ? 10 : 0;

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

    public static function _search($q)
    {
        return Size::where('value', 'LIKE', '%' . $q . '%')->where('is_active', 10)->get()->map->_format();
    }

    public static function _excel_saving($size) 
    {
        if(!$m = Size::where(['value' => $size])->first()) {
            $model                  = new Size();
            $model->user_id         = auth()->user()->id;
            $model->uuid            = Str::uuid()->toString();
            $model->value           = $size;
            $model->is_active       = 10;
            
            if($model->save()){
                return $model->id;
            }
        }
        return false;
    }
}