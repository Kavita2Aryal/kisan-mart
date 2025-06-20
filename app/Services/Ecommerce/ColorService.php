<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Color;
use Illuminate\Support\Str;

class ColorService
{
    public static function _find($uuid)
    {
        return Color::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Color::where('is_active', 10)->orderBy('created_at', 'DESC')->get()->map->_format();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Color::with(['color_group', 'user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new Color();
        $model->name                = strtolower($req->name);
        $model->color_group_id      = $req->color_group;
        $model->value               = $req->value;
        $model->is_active           = $req->has('is_active') ? 10 : 0;
        
        return $model->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->name                = strtolower($req->name);
        $model->color_group_id      = $req->color_group;
        $model->value               = $req->value;
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
        return Color::where('name', 'LIKE', '%' . $q . '%')->where('is_active', 10)->get()->map->_format();
    }

    public static function _excel_saving($color_name, $color_value, $base_color_id) 
    {
        if(!$m = Color::where(['name' => $color_name])->first()) {
            $model                  = new Color();
            $model->user_id         = auth()->user()->id;
            $model->uuid            = Str::uuid()->toString();
            $model->color_group_id  = $base_color_id;
            $model->name            = $color_name;
            $model->value           = $color_value;
            $model->is_active       = 10;
            
            if($model->save()){
                return $model->id;
            }
        }
        return false;
    }
}