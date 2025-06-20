<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use App\Services\Cms\WebAliasService;
use Illuminate\Support\Str;

class GiftVoucherService
{
    public static function _find($uuid)
    {
        return GiftVoucher::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return GiftVoucher::where('is_active', 10)->orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        // $data = GiftVoucher::with(['alias', 'user'])->orderBy('created_at', 'DESC');
        $data = GiftVoucher::with(['user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('title', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new GiftVoucher();
        $model->code            = $req->code;
        $model->title           = ucwords($req->title);
        $model->description     = trim_description($req->description);
        $model->value           = $req->value;
        $model->price           = $req->price;
        $model->start_date      = $req->start_date;
        $model->end_date        = $req->end_date;
        $model->image           = $req->has('image') ? $req->image : null;
        $model->is_active       = $req->has('is_active') ? 10 : 0;
        
        if($model->save()){
            if(str_starts_with($req->alias, 'gift-voucher/')){
                $alias = $req->alias;
            }else{
                $alias = 'gift-voucher/'.$req->alias;
            }
            WebAliasService::_storing('gift_voucher_id', $model->id, $alias);
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
        $model->code            = $req->code;
        $model->title           = ucwords($req->title);
        $model->description     = trim_description($req->description);
        $model->value           = $req->value;
        $model->price           = $req->price;
        $model->start_date      = $req->start_date;
        $model->end_date        = $req->end_date;
        $model->image           = $req->has('image') ? $req->image : null;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if($model->update()){
            if(str_starts_with($req->alias, 'gift-voucher/')){
                $alias = $req->alias;
            }else{
                $alias = 'gift-voucher/'.$req->alias;
            }
            WebAliasService::_updating('gift_voucher_id', $model->id, $alias);
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
}