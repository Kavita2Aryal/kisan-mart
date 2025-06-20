<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Collection\Collection;
use App\Models\Ecommerce\Collection\CollectionProduct;
use App\Services\Ecommerce\ImageUploadService;
use App\Services\Cms\WebAliasService;
use Illuminate\Support\Str;

class CollectionService
{
    public static function _find($uuid)
    {
        return Collection::where('uuid', $uuid)->firstOrFail();
    }

    public static function _findWith($uuid)
    {
        return Collection::with(['products.brand', 'products.product_categories.category'])->where('uuid', $uuid)->firstOrFail();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Collection::with(['alias', 'user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _get()
    {
        return Collection::where('is_active', 10)->orderBy('created_at', 'ASC')->get();
    }

    public static function _get_by_type()
    {
        return Collection::where('is_active', 10)->orderBy('created_at', 'ASC')->get()->groupBy('collection_type');
    }

    public static function _storing($req)
    {
        $collection_types = get_list_group('collection-type');
        if($req->collection_type != null)
        {
            $collection_name = $collection_types[$req->collection_type];
        }else{
            $collection_name = $collection_types[1];
        }
        $model = new Collection();
        $model->name            = $req->name;
        $model->slug            = Str::slug($collection_name.'-'.$req->name);
        $model->image           = $req->image ?? null;
        $model->description     = trim_description($req->description);
        $model->collection_type = $req->collection_type ?? 1;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if ($model->save()) {
            WebAliasService::_storing('collection_id', $model->id, $req->alias);
            return $model;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        if ($req->has('image') && ($model->image != $req->image)) {
            ImageUploadService::_remove($model->image, 'collection');
        }

        $model->name            = $req->name;
        $model->image           = $req->image ?? null;
        $model->description     = trim_description($req->description);
        $model->collection_type = $req->collection_type ?? 1;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if ($model->update()) {
            WebAliasService::_updating('collection_id', $model->id, $req->alias);
            return $model;
        }
        return false;
    }

    public static function _deleting($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        WebAliasService::_deleting('collection_id', $model->id);
        CollectionProduct::where('collection_id', $model->id)->delete();
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

    public static function _manage_saving($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $collection_products = CollectionProduct::select('product_id')->where('collection_id', $model->id)->pluck('product_id')->toArray();
        foreach ($req->products as $row) {
            if (!in_array($row['index'], $collection_products)) {
                $batch[] = [
                    'collection_id' => $model->id,
                    'product_id' => $row['index'],
                ];
            }
        }
        if (isset($batch) && !empty($batch)) {
            CollectionProduct::insert($batch);
        }
        return true;
    }

    public static function _remove_products($product_ids, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        CollectionProduct::where('collection_id', $model->id)->whereIn('product_id', $product_ids)->delete();
        return true;
    }

    public static function _storing_product($collections, $id)
    {
        foreach($collections as $collection)
        {
            $collection_product = CollectionProduct::where('collection_id', $collection)->where('product_id', $id)->first();
            if(!$collection_product)
            {
                $batch[] = [
                    'collection_id' => $collection,
                    'product_id'    => $id
                ];
            }
        }
        if (isset($batch) && !empty($batch)) {
            CollectionProduct::insert($batch);
        }
        return true;
    }
}