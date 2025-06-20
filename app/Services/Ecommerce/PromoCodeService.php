<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\PromoCode\PromoCode;
use App\Models\Ecommerce\PromoCode\PromoCodeProduct;
use App\Services\Cms\WebAliasService;

class PromoCodeService
{
    public static function _find($uuid)
    {
        return PromoCode::where('uuid', $uuid)->firstOrFail();
    }

    public static function _findWith($uuid)
    {
        return PromoCode::with(['products.brand', 'products.product_categories.category'])->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return PromoCode::where('is_active', 10)->orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = PromoCode::orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new PromoCode();
        $model->code                = $req->code;
        $model->minimum_purchase    = $req->minimum_purchase;
        $model->maximum_usage       = $req->maximum_usage;
        $model->discount_type       = $req->discount_type;
        $model->discount_value      = $req->discount;
        $model->type                = $req->type;
        $model->start_date          = $req->start_date;
        $model->end_date            = $req->end_date;
        $model->used_count          = 0;
        $model->is_active           = $req->has('is_active') ? 10 : 0;

        return $model->save() ? $model : false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;
        $current_type = $model->type;
        $model->code                = $req->code;
        $model->minimum_purchase    = $req->minimum_purchase;
        $model->maximum_usage       = $req->maximum_usage;
        $model->discount_type       = $req->discount_type;
        $model->discount_value      = $req->discount;
        $model->type                = $req->type;
        $model->start_date          = $req->start_date;
        $model->end_date            = $req->end_date;
        $model->used_count          = 0;
        $model->is_active           = $req->has('is_active') ? 10 : 0;

        if ($model->update()) {
            if ($current_type != $req->type) {
                self::_manage_remove($model->id);
            }
            return $model;
        }
        return false;
    }

    public static function _deleting($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;
        PromoCodeProduct::where('promo_code_id', $model->id)->delete();

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

        $promocode_products = PromoCodeProduct::select('product_id')->where('promo_code_id', $model->id)->pluck('product_id')->toArray();
        
        foreach ($req->products as $row) {
            if (!in_array($row['index'], $promocode_products)) {
                $batch[] = [
                    'promo_code_id' => $model->id,
                    'product_id' => $row['index'],
                ];
            }
        }
        if (isset($batch) && !empty($batch)) {
            PromoCodeProduct::insert($batch);
        }
        return true;
    }

    public static function _remove_products($product_ids, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        PromoCodeProduct::where('promo_code_id', $model->id)->whereIn('product_id', $product_ids)->delete();
        return true;
    }

    public static function _calculate_promocode($order, $subtotal)
    {
        $total_discount = 0;
        if ($promocode = PromoCode::where('id', $order->promo_code)->firstOrFail()) {
            $promocode_products = PromoCodeProduct::pluck('product_id')->all();
            if ($promocode->type == 1) {
                $total_discount = self::_calculate_discount($promocode, $subtotal);
            } 
            else if ($promocode->type == 2) {
                $order_products = OrderDetail::where('order_id', $order->id)->whereIn('product_id', $promocode_products)->get()->keyBy('product_id')->map->_get_price()->toArray();
                $p_subtotal  =   array_reduce($order_products, function ($res, $item) {
                    return $res + ($item['qty'] * $item['price']);
                }, 0);
                if ($p_subtotal != 0) {
                    $total_discount = self::_calculate_discount($promocode, $p_subtotal);
                }
            } 
            elseif ($promocode->type == 3) {$order_products = OrderDetail::where('order_id', $order->id)->whereNotIn('product_id', $promocode_products)->get()->keyBy('product_id')->map->_get_price()->toArray();
                $p_subtotal  =   array_reduce($order_products, function ($res, $item) {
                    return $res + ($item['qty'] * $item['price']);
                }, 0);
                if ($p_subtotal != 0) {
                    $total_discount = self::_calculate_discount($promocode, $p_subtotal);
                }
            }
        }
        return $total_discount;
    }

    public static function _calculate_discount($promocode, $subtotal)
    {
        $total_discount = 0;
        if($subtotal >= (float) $promocode->minimum_purchase){
            $promo_discount = $promocode->discount_value;
            if ($promocode->discount_type == 1) {
                $total_discount = $promo_discount;
            } else {
                $total_discount = ($promo_discount * $subtotal) / 100;
            }
        }
        return $total_discount;
    }
}
