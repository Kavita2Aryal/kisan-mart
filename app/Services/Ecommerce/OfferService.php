<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Offer\Offer;
use App\Models\Ecommerce\Offer\OfferProduct;
use App\Services\Ecommerce\ImageUploadService;
use App\Services\Cms\WebAliasService;

class OfferService
{
    public static function _find($uuid)
    {
        return Offer::where('uuid', $uuid)->firstOrFail();
    }

    public static function _findWith($uuid)
    {
        return Offer::with(['products.brand', 'products.product_categories.category', 'products.offer'])->where('uuid', $uuid)->firstOrFail();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Offer::with(['alias', 'user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _get()
    {
        return Offer::where('is_active', 10)->orderBy('created_at', 'DESC')->get();
    }

    public static function _storing($req)
    {
        $model = new Offer();
        $model->name            = $req->name;
        $model->title           = $req->title;
        $model->image           = $req->image ?? null;
        $model->description     = trim_description($req->description);
        $model->discount_type   = $req->discount_type ?? 1;
        $model->start_date      = $req->start_date;
        $model->end_date        = $req->end_date;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if ($model->save()) {
            WebAliasService::_storing('offer_id', $model->id, $req->alias);
            return $model;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        if ($req->has('image') && ($model->image != $req->image)) {
            ImageUploadService::_remove($model->image, 'offer');
        }

        $model->name            = $req->name;
        $model->title           = $req->title;
        $model->image           = $req->image ?? null;
        $model->description     = trim_description($req->description);
        $model->discount_type   = $req->discount_type ?? 1;
        $model->start_date      = $req->start_date;
        $model->end_date        = $req->end_date;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if ($model->update()) {
            WebAliasService::_updating('offer_id', $model->id, $req->alias);
            return $model;
        }
        return false;
    }

    public static function _deleting($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        WebAliasService::_deleting('offer_id', $model->id);
        OfferProduct::where('offer_id', $model->id)->delete();
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

        $offer_products = OfferProduct::select('product_id')->where('offer_id', $model->id)->pluck('product_id')->toArray();

        foreach ($req->products as $row) {
            $batch[] = [
                'offer_id' => $model->id,
                'product_id' => $row['index'],
                'discount' => $req->discount,
                'discount_type' => $model->discount_type
            ];

            // to remove the offer product from other offers
            $other_offer_delete_product_ids[] = $row['index'];
            
            // to remove the offer product that already exists in the same offer to create new ones through batch insert
            if (in_array($row['index'], $offer_products)) {
                $same_offer_delete_product_ids[] = $row['index'];
            }
        }
        
        if (isset($other_offer_delete_product_ids) && !empty($other_offer_delete_product_ids)) {
            OfferProduct::where('offer_id', '!=', $model->id)->whereIn('product_id', $other_offer_delete_product_ids)->delete();
        }
        if (isset($same_offer_delete_product_ids) && !empty($same_offer_delete_product_ids)) {
            OfferProduct::where('offer_id', $model->id)->whereIn('product_id', $same_offer_delete_product_ids)->delete();
        }    
        if (isset($batch) && !empty($batch)) {
            OfferProduct::insert($batch);
        }    
        return true;
    }

    public static function _remove_products($product_ids, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        OfferProduct::where('offer_id', $model->id)->whereIn('product_id', $product_ids)->delete();
        return true;
    }

    public static function _discount_updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $offer_products = OfferProduct::select('product_id')->where('offer_id', $model->id)->pluck('product_id')->toArray();

        foreach ($req->products as $row) {
            $batch[] = [
                'offer_id' => $model->id,
                'product_id' => $row['index'],
                'discount' => $row['discount'],
                'discount_type' => $model->discount_type
            ];

            // to remove the offer product that already exists in the same offer to create new ones through batch insert
            if (in_array($row['index'], $offer_products)) {
                $same_offer_delete_product_ids[] = $row['index'];
            }
        }
        
        if (isset($same_offer_delete_product_ids) && !empty($same_offer_delete_product_ids)) {
            OfferProduct::where('offer_id', $model->id)->whereIn('product_id', $same_offer_delete_product_ids)->delete();
        }    
        if (isset($batch) && !empty($batch)) {
            OfferProduct::insert($batch);
        }    
        return true;
    }
}