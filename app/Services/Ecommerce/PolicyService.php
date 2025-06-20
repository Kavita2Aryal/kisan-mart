<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Customer;
use App\Models\Ecommerce\Policy;
use App\Models\Ecommerce\PolicyAgreed;

class PolicyService
{
    public static function _find($uuid)
    {
        return Policy::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Policy::where('is_active', 10)->orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Policy::orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('title', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        self::_policy_agreed_change();

        $model = new Policy();
        $model->title           = $req->title;
        $model->description     = trim_description($req->description);
        $model->effective_date  = $req->effective_date;
        $model->is_active       = $req->has('is_active') ? 10 : 0;
        
        if($model->save()){
            return true;
        }
        return false;
    }

    public static function _policy_agreed_change()
    {
        $policy = Policy::orderBy('created_at', 'DESC')->first();
        if($policy)
        {
            $policy->update(['is_active' => 0]);
            $customers = Customer::select('id', 'agreed_on')->where('has_agreed', 10)->get();
            foreach($customers as $row)
            {
                $batch = [
                    'customer_id' => $row->id,
                    'policy_id' => $policy->id,
                    'agreed_on' => $row->agreed_on
                ];
                $row->update(['has_agreed' => 0, 'agreed_on' => null]);
            }

            if (isset($batch) && !empty($batch)) {
                PolicyAgreed::insert($batch);
                return true;
            }
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;
        $model->title           = $req->title;
        $model->description     = trim_description($req->description);
        $model->effective_date  = $req->effective_date;
        $model->is_active       = $req->has('is_active') ? 10 : 0;

        if($model->update()){
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