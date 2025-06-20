<?php

namespace App\Services\Addons;

use App\Models\Addons\Document;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public static function _find($uuid)
    {
        return Document::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Document::with('user')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Document::with(['user']);
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('filename', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $document = new Document();
        $document->title     = $req->title;
        $document->filename  = $req->filename;
        $document->image_id  = $req->image_id ?? 0;
        $document->is_active = $req->has('is_active') ? 10 : 0;
        return $document->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $document = self::_find($uuid);
        if (!$document) return false;

        $document->title     = $req->title;
        $document->filename  = $req->filename;
        $document->image_id  = $req->image_id ?? 0;
        $document->is_active = $req->has('is_active') ? 10 : 0;
        return $document->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $document = self::_find($uuid);
        if (!$document) return false;

        Storage::delete('public/document/' . $document->filename);
        return $document->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $document = self::_find($uuid);
        if (!$document) return -1;

        $document->is_active = ($document->is_active == 10 ? 0 : 10);
        $document->update();
        return $document->is_active;
    }
}