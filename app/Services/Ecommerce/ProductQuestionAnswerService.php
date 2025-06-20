<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\ProductQuestionAnswer;

class ProductQuestionAnswerService
{
    public static function _find($uuid)
    {
        return ProductQuestionAnswer::where('uuid', $uuid)->firstOrFail();
    }

    public static function _paging($req, $type)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = ProductQuestionAnswer::with(['user', 'customer', 'product'])->orderBy('created_at', 'DESC');
        if($type == 'pending')
        {
            $data->whereNull('answer');
        }else{
            $data->whereNotNull('answer');
        }
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('question', 'LIKE', '%'.$search.'%')
                    ->orWhere('answer', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _updating($answer, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->answer        = trim_description($answer);
        $model->replied_at    = now();
        $model->user_id       = auth()->user()->id;
        return $model->update() ? true : false;
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