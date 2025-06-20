<?php

namespace App\Services\Addons\Blog;

use App\Models\Addons\Blog\Blog;

use App\Services\Addons\Blog\BlogContentService;
use App\Services\Addons\Blog\BlogSeoService;
use App\Services\Cms\WebAliasService;

class BlogService
{
    public static function _find($uuid)
    {
        return Blog::with('contents')->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Blog::with(['user', 'author', 'category', 'alias'])->orderBy('created_at', 'ASC')->get();
    }

    public static function _paging($req, $trash)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Blog::with(['user', 'author', 'category', 'alias'])->orderBy('created_at', 'DESC');

        if ($trash) {
            $data->onlyTrashed();
        }
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('author', function ($query1) use ($search) {
                        $query1->where('name', 'LIKE', '%'.$search.'%');
                    })
                    ->orWhereHas('category', function ($query2) use ($search) {
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $blog                  = new Blog();
        $blog->title           = $req->title;
        $blog->intro_image_id  = $req->intro_image_id;
        $blog->banner_image_id = $req->banner_image_id;
        $blog->subtitle        = $req->subtitle;
        $blog->author_id       = $req->author_id;
        $blog->category_id     = $req->category_id;
        $blog->keywords        = $req->keywords;
        $blog->is_active       = $req->has('is_active') ? 10 : 0;            
        $blog->published_at    = $req->published_at != null ? date('Y-m-d', strtotime($req->published_at)) : null;

        if ($blog->save()) {
            WebAliasService::_storing('blog_id', $blog->id, $req->alias);
            BlogSeoService::_storing($req->seo, $blog->id);
            BlogContentService::_storing($req->contents, $blog->id);
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $blog = self::_find($uuid);
        if (!$blog) return false;

        $blog->title           = $req->title;
        $blog->intro_image_id  = $req->intro_image_id;
        $blog->banner_image_id = $req->banner_image_id;
        $blog->subtitle        = $req->subtitle;
        $blog->author_id       = $req->author_id;
        $blog->category_id     = $req->category_id;
        $blog->keywords        = $req->keywords;
        $blog->is_active       = $req->has('is_active') ? 10 : 0;            
        $blog->published_at    = $req->published_at != null ? date('Y-m-d', strtotime($req->published_at)) : null;

        if ($blog->update()) {
            WebAliasService::_updating('blog_id', $blog->id, $req->alias);
            BlogSeoService::_updating($req->seo, $blog->id);
            BlogContentService::_deleting($blog->id);
            BlogContentService::_storing($req->contents, $blog->id);
            return true;
        }
        return false;
    }

    public static function _deleting($uuid) 
    {
        $blog = self::_find($uuid);
        if (!$blog) return false;

        WebAliasService::_deleting('blog_id', $blog->id);
        BlogSeoService::_deleting($blog->id);
        BlogContentService::_deleting($blog->id);
        return $blog->forceDelete() ? true : false;
    }

    public static function _soft_deleting($uuid) 
    {
        $blog = self::_find($uuid);
        if (!$blog) return false;

        return $blog->delete() ? true : false;
    }

    public static function _restoring($uuid)
    {
        $blog = Blog::where('uuid', $uuid)->onlyTrashed()->first();
        if (!$blog) return false;

        return $blog->restore() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $blog = self::_find($uuid);
        if (!$blog) return -1;

        $blog->is_active = ($blog->is_active == 10 ? 0 : 10);
        $blog->update();
        return $blog->is_active;
    }

    public static function _searching($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);
        $search_dates = search_filter_string($req->search_dates ?? null);

        $data = Blog::orderBy('published_at', 'DESC');
        
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