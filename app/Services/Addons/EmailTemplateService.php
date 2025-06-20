<?php

namespace App\Services\Addons;

use Illuminate\Support\Str;
use App\Models\Addons\EmailTemplate;

class EmailTemplateService
{
    public static function _find($uuid)
    {
        return EmailTemplate::where('uuid', $uuid)->firstOrFail();
    }

    public static function _findSlug($slug)
    {
        return EmailTemplate::where('slug', $slug)->first() ?? null;
    }

    public static function _get()
    {
        return EmailTemplate::with('user')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = EmailTemplate::with(['user']);
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('template', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)       
    {
        $template = new EmailTemplate();
        $template->title    = $req->title;
        $template->template = trim_description($req->template);
        $template->hint     = $req->hint;
        return $template->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $template = self::_find($uuid);
        if (!$template) return false;

        $template->title    = $req->title;
        $template->template = trim_description($req->template);
        $template->hint     = $req->hint;
        return $template->update() ? true : false;
    }

   
    public static function _use($slug, $array)
    {
        $data = self::_findSlug($slug);
        $replaced = $data->template;
        
        if ($array != null && is_array($array)) {
            foreach ($array as $row) {
                $replaced = Str::replace($row['search'], $row['replace'], $replaced);
            }
        }
        return $replaced;
    }
}