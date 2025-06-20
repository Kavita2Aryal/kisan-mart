<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\CategoryAssignProduct;
use App\Services\Cms\WebAliasService;
use Illuminate\Support\Str;

class CategoryService
{
    public static function _find($uuid)
    {
        return Category::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Category::where('is_active', 10)->orderBy('created_at', 'DESC')->get();
    }

    public static function _get_parent()
    {
        return Category::where('parent_id', 0)->where('is_active', 10)->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Category::with(['parent', 'alias', 'user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new Category();
        $model->name            = ucwords($req->name);
        $model->parent_id       = ($req->parent_category != null) ? $req->parent_category : 0;
        $model->description     = trim_description($req->description);
        $model->image           = $req->has('image') ? $req->image : null;
        $model->is_active       = $req->has('is_active') ? 10 : 0;
        
        if($model->save()){
            $alias = 'categories/'.$req->alias;
            WebAliasService::_storing('category_id', $model->id, $alias);
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
        $model->parent_id       = ($req->parent_category != null) ? $req->parent_category : 0;
        $model->description     = trim_description($req->description);
        $model->image           = $req->has('image') ? $req->image : null;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if($model->update()){
            if(str_starts_with($req->alias, 'categories/')){
                $alias = $req->alias;
            }else{
                $alias = 'categories/'.$req->alias;
            }
            WebAliasService::_updating('category_id', $model->id, $alias);
            self::_assign_products($model->id, $req);
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

    public static function _assign_products($id, $req)
    {
        CategoryAssignProduct::where('category_id', $id)->delete();
        if($req->has('products') && $req->products != null)
        {
            $batch = [];
            foreach ($products as $row) {
                $batch[] = [
                    'category_id'   => $id,
                    'product_id' => $row,
                ];
            }

            if (isset($batch) && !empty($batch)) {
                CategoryAssignProduct::insert($batch);
                return true;
            }
            return false;
        }
        return true;
    }

    public static function _excel_saving($categories) 
    {
        $cat = explode('|', $categories);
        if($cat) {
            foreach($cat as $c) {
                if(!$cmodel = Category::where(['name' => $c])->first()) {
                    $model                  = new Category();
                    $model->user_id         = auth()->user()->id;
                    $model->uuid            = Str::uuid()->toString();
                    $model->name            = $c;
                    $model->parent_id       = 0;
                    $model->description     = null;
                    $model->image           = null;
                    $model->is_active       = 10;
                    
                    if($model->save()){
                        $alias = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '%', ' '), '-',  Str::lower($c));
                        WebAliasService::_storing('category_id', $model->id, $alias);
                    }
                }
            }
        }
        else {
            if(!$cmodel = Category::where(['name' => $categories])->first()) {
                $model                  = new Category();
                $model->user_id         = auth()->user()->id;
                $model->uuid            = Str::uuid()->toString();
                $model->name            = $categories;
                $model->parent_id       = 0;
                $model->description     = null;
                $model->image           = null;
                $model->is_active       = 10;
                
                if($model->save()){
                    $alias = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '%', ' '), '-',  Str::lower($categories));
                    WebAliasService::_storing('category_id', $model->id, $alias);
                }
            }
        }
        return true;
    }
}