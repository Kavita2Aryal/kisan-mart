<?php

namespace App\Services\Addons;

use App\Models\Addons\Partner;

class PartnerService
{
    public static function _find($uuid)
    {
        return Partner::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Partner::with('user')->orderBy('display_order', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Partner::with(['user'])->orderBy('display_order', 'ASC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $partner = new Partner();
        $partner->name          = $req->name;
        $partner->description   = trim_description($req->description);
        $partner->image_id      = $req->image_id ?? 0;
        $partner->display_order = self::_max_order();
        $partner->is_active     = $req->has('is_active') ? 10 : 0;
        return $partner->save() ? true : false;
    }

    public static function _updating($req, $id)
    {
        $partner = self::_find($id);
        if (!$partner) return false;

        $partner->name        = $req->name;
        $partner->description = trim_description($req->description);
        $partner->image_id    = $req->image ?? 0;
        $partner->is_active   = $req->has('is_active') ? 10 : 0;
        return $partner->update() ? true : false;
    }

    public static function _deleting($id) 
    {
        $partner = self::_find($id);
        if (!$partner) return false;

        return $partner->delete() ? true : false;
    }

    public static function _change_status($id)
    {
        $partner = self::_find($id);
        if (!$partner) return -1;

        $partner->is_active = ($partner->is_active == 10 ? 0 : 10);
        $partner->update();
        return $partner->is_active;
    }
    public static function _ordering($data)
    {
        $i=0;
        foreach($data as $id) {
            if ($partner = Partner::find($id)) {
                $i++;
                $partner->display_order=$i;
                $partner->update();
            }
        }
    }

    public static function _max_order()
    {
        $max_display_order = 1;
        if ($partner = Partner::select('display_order')->orderBy('display_order','DESC')->first()) {
            $max_display_order = $partner->display_order + 1;
        }
        return $max_display_order;
    }
}