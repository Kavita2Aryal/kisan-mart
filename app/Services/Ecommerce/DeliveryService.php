<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Delivery\Delivery;
use App\Models\Ecommerce\Delivery\DeliveryArea;

class DeliveryService
{
    public static function _find($uuid)
    {
        return Delivery::with(['areas'])->where('uuid', $uuid)->firstOrFail();
    }
    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);
        $data = Delivery::with(['user'])->orderBy('created_at', 'DESC');
        if ($search) {
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new Delivery();
        $model->name            = ucwords($req->name);
        $model->day     = $req->day;
        $model->minimum_order_amount = $req->minimum_order_amount;
        $model->discount_type = $req->discount_type;
        $model->delivery_type = $req->delivery_type;
        $model->discount_value = $req->discount_value;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if($model->save()){

            foreach ($req->area_id as $id){
                DeliveryArea::create([
                    'delivery_id' =>$model->id,
                    'area_id' => $id,
                    'day' => $req->day
                ]);
            }
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->name            = ucwords($req->name);
        $model->day     = $req->day;
        $model->minimum_order_amount = $req->minimum_order_amount;
        $model->discount_type = $req->discount_type;
        $model->delivery_type = $req->delivery_type;
        $model->discount_value = $req->discount_value;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if($model->update()){
            $model->areas()->delete();
            foreach ($req->area_id as $id){
                DeliveryArea::create([
                    'delivery_id' =>$model->id,
                    'area_id' => $id,
                    'day' => $req->day
                ]);
            }
            return true;
        }
        return false;
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
