<?php

namespace App\Services\Addons\News;

use App\Models\Addons\News\News;

use App\Services\Addons\News\NewsContentService;
use App\Services\Addons\News\NewsSeoService;
use App\Services\Cms\WebAliasService;

class NewsService
{
    public static function _find($uuid)
    {
        return News::with('contents')->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return News::with(['user', 'author', 'alias'])->orderBy('created_at', 'ASC')->get();
    }

    public static function _paging($req, $trash)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = News::with(['user', 'author', 'alias'])->orderBy('created_at', 'DESC');
        
        if ($trash) {
            $data->onlyTrashed();
        }
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('author', function ($query1) use ($search) {
                        $query1->where('name', 'LIKE', '%'.$search.'%');
                    });
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $news                  = new News();
        $news->title           = $req->title;
        $news->intro_image_id  = $req->intro_image_id;
        $news->banner_image_id = $req->banner_image_id;
        $news->subtitle        = $req->subtitle;
        $news->author_id       = $req->author_id;
        $news->keywords        = $req->keywords;
        $news->is_active       = $req->has('is_active') ? 10 : 0;              
        $news->published_at    = $req->published_at != null ? date('Y-m-d', strtotime($req->published_at)) : null;

        if ($news->save()) {
            WebAliasService::_storing('news_id', $news->id, $req->alias);
            NewsSeoService::_storing($req->seo, $news->id);
            NewsContentService::_storing($req->contents, $news->id);
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $news = self::_find($uuid);
        if (!$news) return false;

        $news->title           = $req->title;
        $news->intro_image_id  = $req->intro_image_id;
        $news->banner_image_id = $req->banner_image_id;
        $news->subtitle        = $req->subtitle;
        $news->author_id       = $req->author_id;
        $news->keywords        = $req->keywords;
        $news->is_active       = $req->has('is_active') ? 10 : 0;              
        $news->published_at    = $req->published_at != null ? date('Y-m-d', strtotime($req->published_at)) : null;

        if ($news->update()) {
            WebAliasService::_updating('news_id', $news->id, $req->alias);
            NewsSeoService::_updating($req->seo, $news->id);
            NewsContentService::_deleting($news->id);
            NewsContentService::_storing($req->contents, $news->id);
            return true;
        }
        return false;
    }

    public static function _deleting($uuid) 
    {
        $news = self::_find($uuid);
        if (!$news) return false;

        WebAliasService::_deleting('news_id', $news->id);
        NewsSeoService::_deleting($news->id);
        NewsContentService::_deleting($news->id);
        return $news->forceDelete() ? true : false;
    }

    public static function _soft_deleting($uuid) 
    {
        $news = self::_find($uuid);
        if (!$news) return false;

        return $news->delete() ? true : false;
    }

    public static function _restoring($uuid)
    {
        $news = News::where('uuid', $uuid)->onlyTrashed()->first();
        if (!$news) return false;

        return $news->restore() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $news = self::_find($uuid);
        if (!$news) return -1;

        $news->is_active = ($news->is_active == 10 ? 0 : 10);
        $news->update();
        return $news->is_active;
    }

    public static function _searching($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);
        $search_dates = search_filter_string($req->search_dates ?? null);

        $data = News::orderBy('published_at', 'DESC');
        
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