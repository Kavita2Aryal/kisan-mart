<?php

namespace App\Services\Ecommerce\Order;

use App\Models\Ecommerce\Order\OrderStatus;

class OrderStatusService
{
    public static function _find($id)
    {
        return OrderStatus::where('order_id', '=', $id)->where('is_active', '=', 10)->first();
    }

    public static function _update($model, $req, $status)
    {
        $osmodel = self::_find($model->id);
        $osmodel->is_active         = 0;

        if ($osmodel->update()) {
            $smodel             = new OrderStatus();
            $smodel->order_id   = $model->id;
            $smodel->status     = $status;
            $smodel->remarks    = $req->remarks;
            $smodel->user_id    = auth()->user()->id;
            $smodel->is_active  = 10;
            if ($smodel->save()) {
                return true;
            }
        }
        return false;
    }
}
