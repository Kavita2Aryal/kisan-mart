<?php

namespace App\Services\Addons\Event;

use App\Models\Addons\Event\Event;

use App\Services\Addons\Event\EventContentService;
use App\Services\Addons\Event\EventSeoService;
use App\Services\Cms\WebAliasService;

class EventService
{
    public static function _find($uuid)
    {
        return Event::with('contents')->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Event::with(['user', 'alias'])->orderBy('created_at', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Event::with(['user', 'alias'])->orderBy('created_at', 'DESC');

        if ($trash) {
            $data->onlyTrashed();
        }
        if ($search) { 
            $data->where('title', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $event_date = $req->event_date != null ? explode(' - ', $req->event_date) : null;
        $start_date = $event_date != null ? date('Y-m-d', strtotime($event_date[0])) : null;
        $end_date   = $event_date != null ? date('Y-m-d', strtotime($event_date[1])) : null;

        $event                  = new Event();
        $event->title           = $req->title;
        $event->intro_image_id  = $req->intro_image_id;
        $event->banner_image_id = $req->banner_image_id;
        $event->subtitle        = $req->subtitle;
        $event->keywords        = $req->keywords;
        $event->is_active       = $req->has('is_active') ? 10 : 0;             
        $event->start_date      = $start_date;
        $event->end_date        = $end_date;

        if ($event->save()) {
            WebAliasService::_storing('event_id', $event->id, $req->alias);
            EventSeoService::_storing($req->seo, $event->id);
            EventContentService::_storing($req->contents, $event->id);
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $event_date = $req->event_date != null ? explode(' - ', $req->event_date) : null;
        $start_date = $event_date != null ? date('Y-m-d', strtotime($event_date[0])) : null;
        $end_date   = $event_date != null ? date('Y-m-d', strtotime($event_date[1])) : null;
        
        $event = self::_find($uuid);
        if (!$event) return false;

        $event->title           = $req->title;
        $event->intro_image_id  = $req->intro_image_id;
        $event->banner_image_id = $req->banner_image_id;
        $event->subtitle        = $req->subtitle;
        $event->keywords        = $req->keywords;
        $event->is_active       = $req->has('is_active') ? 10 : 0;       
        $event->start_date      = $start_date;
        $event->end_date        = $end_date;

        if ($event->update()) {
            WebAliasService::_updating('event_id', $event->id, $req->alias);
            EventSeoService::_updating($req->seo, $event->id);
            EventContentService::_deleting($event->id);
            EventContentService::_storing($req->contents, $event->id);
            return true;
        }
        return false;
    }

    public static function _deleting($uuid) 
    {
        $event = self::_find($uuid);
        if (!$event) return false;

        WebAliasService::_deleting('event_id', $event->id);
        EventSeoService::_deleting($event->id);
        EventContentService::_deleting($event->id);
        return $event->forceDelete() ? true : false;
    }

    public static function _soft_deleting($uuid) 
    {
        $event = self::_find($uuid);
        if (!$event) return false;

        return $event->delete() ? true : false;
    }

    public static function _restoring($uuid)
    {
        $event = Event::where('uuid', $uuid)->onlyTrashed()->first();
        if (!$event) return false;

        return $event->restore() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $event = self::_find($uuid);
        if (!$event) return -1;

        $event->is_active = ($event->is_active == 10 ? 0 : 10);
        $event->update();
        return $event->is_active;
    }

    public static function _searching($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);
        $search_dates = search_filter_string($req->search_dates ?? null);

        $data = Event::orderBy('published_at', 'DESC');
        
        if ($search) { 
            $data->where('title', 'LIKE', '%'.$search.'%');
        }
        if ($search_dates) { 
            $search_dates = explode(' - ', $search_dates); 
            if (trim($search_dates[0]) != '') {
                $data->where('published_at', '>=', trim($search_dates[0]));
            }
            if (trim($search_dates[1]) != '') {
                $data->where('published_at', '<=', trim($search_dates[1]));
            }
        }
        return $data->paginate($per_page);
    }
}