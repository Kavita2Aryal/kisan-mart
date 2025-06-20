<?php

namespace App\Services\Addons;

use App\Models\Addons\Author;

class AuthorService
{
    public static function _find($uuid)
    {
        return Author::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Author::with('user')->orderBy('created_at', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Author::with(['user'])->orderBy('name', 'ASC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $author = new Author();
        $author->name 		 = $req->name;
        $author->description = $req->description;
        $author->image_id    = $req->image_id ?? 0;
        $author->is_active 	 = $req->has('is_active') ? 10 : 0;
        return $author->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $author = self::_find($uuid);
        if (!$author) return false;

        $author->name 		 = $req->name;
        $author->description = $req->description;
        $author->image_id    = $req->image_id ?? 0;
        $author->is_active   = $req->has('is_active') ? 10 : 0;
        return $author->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $author = self::_find($uuid);
        if (!$author) return false;

        return $author->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $author = self::_find($uuid);
        if (!$author) return -1;

        $author->is_active = ($author->is_active == 10 ? 0 : 10);
        $author->update();
        return $author->is_active;
    }
}