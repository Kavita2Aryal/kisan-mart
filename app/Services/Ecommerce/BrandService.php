<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Brand;
use App\Services\Cms\WebAliasService;
use Illuminate\Support\Str;

class BrandService
{
    public static function _find($uuid)
    {
        return Brand::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Brand::where('is_active', 10)->orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Brand::with(['alias', 'user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new Brand();
        $model->name            = ucwords($req->name);
        $model->description     = trim_description($req->description);
        $model->image           = $req->has('image') ? $req->image : null;
        $model->is_active       = $req->has('is_active') ? 10 : 0;
        
        if($model->save()){
            WebAliasService::_storing('brand_id', $model->id, $req->alias);
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;
        if($req->has('image') && ($model->image != $req->image)){
            ImageUploadService::_remove($model->image, 'ecommerce');
        }
        $model->name            = ucwords($req->name);
        $model->description     = trim_description($req->description);
        $model->image           = $req->has('image') ? $req->image : null;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if($model->update()){
            WebAliasService::_updating('brand_id', $model->id, $req->alias);
            return true;
        }
        return false;
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

    public static function _excel_saving($brand_name) 
    {
        if(!$m = Brand::where(['name' => $brand_name])->first()) {
            $model                  = new Brand();
            $model->user_id         = auth()->user()->id;
            $model->uuid            = Str::uuid()->toString();
            $model->name            = $brand_name;
            $model->description     = null;
            $model->image           = null;
            $model->is_active       = 10;
            
            if($model->save()){
                $alias = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '%', ' '), '-',  Str::lower($brand_name));
                WebAliasService::_storing('brand_id', $model->id, $alias);
                return $model->id;
            }
        }
        return false;
    }
}