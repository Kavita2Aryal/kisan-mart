<?php

namespace App\Services\Addons;

use App\Models\Addons\SocialMedia;

class SocialMediaService
{
    public static function _find($uuid)
    {
        return SocialMedia::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return SocialMedia::with('user')->orderBy('display_order', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = SocialMedia::with(['user'])->orderBy('display_order', 'ASC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('social', 'LIKE', '%'.$search.'%')
                    ->orWhere('link', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $social_media = new SocialMedia();
        $social_media->social 		  = $req->social;
        $social_media->link 		  = $req->link;
        $social_media->display_order  = self::_max_order();
        $social_media->is_active 	  = $req->has('is_active') ? 10 : 0;
        return $social_media->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $social_media = self::_find($uuid);
        if (!$social_media) return false;

        $social_media->social 	  = $req->social;
        $social_media->link      = $req->link;
        $social_media->is_active = $req->has('is_active') ? 10 : 0;
        return $social_media->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $social_media = self::_find($uuid);
        if (!$social_media) return false;
        
        return $social_media->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $social_media = self::_find($uuid);
        if (!$social_media) return -1;

        $social_media->is_active = ($social_media->is_active == 10 ? 0 : 10);
        $social_media->update();
        return $social_media->is_active;
    }

    public static function _ordering($social_medias)
    {
        $display_order = 0; 
        foreach ($social_medias as $id) {
            if ($social_media = SocialMedia::find($id)) {
                $display_order++;
                $social_media->display_order = $display_order;
                $social_media->update();
            }
        }
    }

    public static function _max_order()
    {
    	$max_display_order = 1;
        if ($social_media = SocialMedia::select('display_order')->orderBy('display_order','DESC')->first()) {
            $max_display_order = $social_media->display_order + 1;
        }
        return $max_display_order;
    }
}