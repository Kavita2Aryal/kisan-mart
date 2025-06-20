<?php

namespace App\Services\Cms\Popup;

use App\Models\Cms\Popup\Popup;
use App\Services\Cms\Popup\PopupPageService;

class PopupService
{
    public static function _find($uuid)
    {
        return Popup::with('pages')->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Popup::with('user')->orderBy('created_at', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Popup::orderBy('id', 'DESC');
        if ($search) { 
            $data->where('title', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $popup                = new Popup();
        $popup->title         = $req->title;
        $popup->description   = trim_description($req->description);
        $popup->image_id      = $req->image_id ?? 0;
        $popup->video_link    = $req->video;
        $popup->external_link = $req->external;
        $popup->is_active     = $req->has('is_active') ? 10 : 0;   
        
        if ($popup->save()) {
            if ($req->has('pages')) {
                PopupPageService::_storing($req->pages, $popup->id);
            }
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $popup = self::_find($uuid);
        if (!$popup) return false;

        $popup->title         = $req->title;
        $popup->description   = trim_description($req->description);
        $popup->image_id      = $req->image_id ?? 0;
        $popup->video_link    = $req->video;
        $popup->external_link = $req->external;
        $popup->is_active     = $req->has('is_active') ? 10 : 0;       

        if ($popup->update()) {
            if ($req->has('pages')) {
                PopupPageService::_deleting($popup->id);
                PopupPageService::_storing($req->pages, $popup->id);
            }
            return true;
        }
        return false;
    }

    public static function _deleting($uuid) 
    {
        $popup = self::_find($uuid);
        if (!$popup) return false;

        if ($popup->pages != null) {
            PopupPageService::_deleting($popup->id);
        }
        return $popup->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $popup =  self::_find($uuid);
        if (!$popup) return -1;

        $popup->is_active = ($popup->is_active == 10 ? 0 : 10);
        $popup->update();
        return $popup->is_active;
    }
}