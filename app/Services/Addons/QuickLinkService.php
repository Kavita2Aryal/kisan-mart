<?php

namespace App\Services\Addons;

use App\Models\Addons\QuickLink;

class QuickLinkService
{
    public static function _find($uuid)
    {
        return QuickLink::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get($group_id = null)
    {
        return $group_id != null 
            ? QuickLink::where('group_id', $group_id)->orderBy('display_order', 'ASC')->get()
            : QuickLink::with('user')->orderBy('group_id', 'ASC')->orderBy('display_order', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = QuickLink::with(['user'])->orderBy('group_id', 'ASC')->orderBy('display_order', 'ASC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('link', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $quick_link = new QuickLink();
        $quick_link->group_id 		= $req->group_id;
        $quick_link->title 			= $req->title;
        $quick_link->link 			= $req->link;
        $quick_link->display_order 	= self::_max_order($req->group_id);
        $quick_link->is_active 		= $req->has('is_active') ? 10 : 0;
        return $quick_link->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $quick_link = self::_find($uuid);
        if (!$quick_link) return false;

        $quick_link->group_id 		= $req->group_id;
        $quick_link->title 			= $req->title;
        $quick_link->link 			= $req->link;
        $quick_link->is_active 		= $req->has('is_active') ? 10 : 0;
        return $quick_link->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $quick_link = self::_find($uuid);
        if (!$quick_link) return false;

        return $quick_link->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $quick_link = self::_find($uuid);
        if (!$quick_link) return -1;

        $quick_link->is_active = ($quick_link->is_active == 10 ? 0 : 10);
        $quick_link->update();
        return $quick_link->is_active;
    }

    public static function _ordering($quick_links)
    {
        $display_order = 0; 
        foreach ($quick_links as $id) {
            if ($quick_link = QuickLink::find($id)) {
                $display_order++;
                $quick_link->display_order = $display_order;
                $quick_link->update();
            }
        }
    }

    public static function _max_order($group_id)
    {
    	$max_display_order = 1;
        if ($quick_link = QuickLink::select('display_order')->where('group_id', $group_id)->orderBy('display_order','DESC')->first()) {
            $max_display_order = $quick_link->display_order + 1;
        }
        return $max_display_order;
    }
}