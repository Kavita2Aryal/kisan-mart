<?php

namespace App\Services\Addons\Blog;

use App\Models\Addons\Blog\BlogCategory;

class BlogCategoryService
{
    public static function _find($uuid)
    {
        return BlogCategory::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return BlogCategory::orderBy('created_at', 'ASC')->get();
    }

    public static function _paging($req, $trash)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = BlogCategory::with(['user'])->orderBy('created_at', 'DESC');

        if ($trash) {
            $data->onlyTrashed();
        }
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('name', function ($query2) use ($search) {
                        $query2->where('name', 'LIKE', '%'.$search.'%');
                    });
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)       
    {
        $blog_category = new BlogCategory();
        $blog_category->name      = $req->name;
        $blog_category->is_active = $req->has('is_active') ? 10 : 0;   

        return $blog_category->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $blog_category = self::_find($uuid);
        if (!$blog_category) return false;

        $blog_category->name      = $req->name;
        $blog_category->is_active = $req->has('is_active') ? 10 : 0;   

        return $blog_category->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $blog_category = self::_find($uuid);
        if (!$blog_category) return false;
        
        return $blog_category->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $blog_category = self::_find($uuid);
        if (!$blog_category) return -1;

        $blog_category->is_active = ($blog_category->is_active == 10 ? 0 : 10);
        $blog_category->update();
        return $blog_category->is_active;
    }
}