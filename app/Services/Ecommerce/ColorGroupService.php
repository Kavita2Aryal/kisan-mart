<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\ColorGroup;
use Database\Factories\Ecommerce\ColorGroupFactory;
use Illuminate\Support\Str;

class ColorGroupService
{
    public static function _find($uuid)
    {
        return ColorGroup::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return ColorGroup::where('is_active', 10)->orderBy('name', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = ColorGroup::orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new ColorGroup();
        $model->name                = strtolower($req->name);
        //$model->slug                = $req->slug; //only for feature testing
        $model->value               = $req->value;
        $model->is_active           = $req->has('is_active') ? 10 : 0;
        
        return $model->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->name                = strtolower($req->name);
        //$model->slug                = $req->slug; //only for feature testing
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
        return ColorGroup::where('name', 'LIKE', '%' . $q . '%')->where('is_active', 10)->get()->map->_format();
    }

    public static function _excel_saving($name, $value) 
    {
        if(!$m = ColorGroup::where(['name' => $name])->first()) {
            $model                  = new ColorGroup();
            $model->user_id         = auth()->user()->id;
            $model->uuid            = Str::uuid()->toString();
            $model->name            = $name;
            $model->value           = null;
            $model->is_active       = 10;
            
            if($model->save()){
                return $model->id;
            }
        }
        return false;
    }
}