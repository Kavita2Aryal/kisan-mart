<?php

namespace App\Services\Addons;

use App\Models\Addons\Faq;

class FaqService
{
    public static function _find($uuid)
    {
        return Faq::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Faq::with('user')->orderBy('display_order', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Faq::with(['user'])->orderBy('display_order', 'ASC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('question', 'LIKE', '%'.$search.'%')
                    ->orWhere('answer', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)       
    {
        $faq = new Faq();
        $faq->question      = $req->question;
        $faq->answer        = trim_description($req->answer);
        $faq->display_order = self::_max_order();
        $faq->is_active     = $req->has('is_active') ? 10 : 0;
        return $faq->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $faq = self::_find($uuid);
        if (!$faq) return false;

        $faq->question      = $req->question;
        $faq->answer        = trim_description($req->answer);
        $faq->is_active     = $req->has('is_active') ? 10 : 0;
        return $faq->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $faq = self::_find($uuid);
        if (!$faq) return false;
        
        return $faq->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $faq = self::_find($uuid);
        if (!$faq) return -1;

        $faq->is_active = ($faq->is_active == 10 ? 0 : 10);
        $faq->update();
        return $faq->is_active;
    }

    public static function _ordering($faqs)
    {
        $display_order = 0; 
        foreach ($faqs as $id) {
            if ($faq = Faq::find($id)) {
                $display_order++;
                $faq->display_order = $display_order;
                $faq->update();
            }
        }
    }

    public static function _max_order()
    {
    	$max_display_order = 1;
        if ($faq = Faq::select('display_order')->orderBy('display_order','DESC')->first()) {
            $max_display_order = $faq->display_order + 1;
        }
        return $max_display_order;
    }
}