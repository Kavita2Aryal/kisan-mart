<?php

namespace App\Services\Addons;

use App\Models\Addons\Testimonial;

class TestimonialService
{
    public static function _find($uuid)
    {
        return Testimonial::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get($sort = true)
    {
        return ($sort)
            ? Testimonial::with(['user', 'image'])->orderBy('display_order', 'ASC')->get()
            : Testimonial::orderBy('display_order', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Testimonial::with(['user'])->orderBy('display_order', 'ASC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('position', 'LIKE', '%'.$search.'%')
                    ->orWhere('title', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $testimonial = new Testimonial();
        $testimonial->name          = $req->name;
        $testimonial->position      = $req->position;
        $testimonial->title      	= $req->title;
        $testimonial->description   = trim_description($req->description);
        $testimonial->published_at  = $req->published_at;
        $testimonial->image_id      = $req->image_id;
        $testimonial->display_order = self::_max_order();
        $testimonial->is_active     = $req->has('is_active') ? 10 : 0;
        return $testimonial->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $testimonial = self::_find($uuid);
        if (!$testimonial) return false;

        $testimonial->name          = $req->name;
        $testimonial->position      = $req->position;
        $testimonial->title      	= $req->title;
        $testimonial->description   = trim_description($req->description);
        $testimonial->published_at  = $req->published_at;
        $testimonial->image_id      = $req->image_id;
        $testimonial->is_active     = $req->has('is_active') ? 10 : 0;
        return $testimonial->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $testimonial = self::_find($uuid);
        if (!$testimonial) return false;
        
        return $testimonial->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $testimonial = self::_find($uuid);
        if (!$testimonial) return -1;

        $testimonial->is_active = ($testimonial->is_active == 10 ? 0 : 10);
        $testimonial->update();
        return $testimonial->is_active;
    }

    public static function _ordering($testimonials)
    {
        $display_order = 0; 
        foreach ($testimonials as $id) {
            if ($testimonial = Testimonial::find($id)) {
                $display_order++;
                $testimonial->display_order = $display_order;
                $testimonial->update();
            }
        }
    }

    public static function _max_order()
    {
    	$max_display_order = 1;
        if ($testimonial = Testimonial::select('display_order')->orderBy('display_order','DESC')->first()) {
            $max_display_order = $testimonial->display_order + 1;
        }
        return $max_display_order;
    }
}