<?php

namespace App\Services\Cms;

use App\Models\Cms\ImageX;
use DB;

class MediaService
{
    public static function _new_filename($image)
    {
        $original_name = preg_replace('/\..+$/', '', $image->getClientOriginalName());
        $original_name = preg_replace('/\s/', '_', $original_name);
        $rep_original  = str_replace( array( '\'', '"',',' , ';','-', '<', '>','_','$','$','%' ), '_', $original_name);
        $rep_original  = substr($rep_original, 0, 75);
        return $rep_original.'-'.time().'.'.$image->getClientOriginalExtension();
    }

    public static function _paging($req)
    {
        $search = search_filter_string($req->search ?? null);
        
        $data = ImageX::orderBy('id', 'DESC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('image', 'LIKE', '%'.$search.'%')
                    ->orWhere('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('caption', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate(32);
    }

    public static function _storing($image, $title)
    {
        $media = new ImageX();
        $media->image = $image;
        $media->title = $title;
        return $media->save() ? $media->id : false;
    }

    public static function _updating($req)
    {
        $media = ImageX::find($req->id);
        if (!$media) return false;
    
        $media->title   = $req->image_title;
        $media->caption = $req->image_caption;
        return $media->update();
    }

    public static function _deleting($image)
    {
        ImageX::where('image', $image)->delete();
    }

    public static function _cropping($image_name, $image_data)
    {
        $img_array = explode('.', $image_name);
        $filename = 'image_' . time() . '.' . end($img_array);
        $output_file = storage_path('/app/public/media/' . $filename);
        $data = explode(',', $image_data);
        $ifp = fopen($output_file, "wb");
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
        return $filename;
    }

    public static function _check_if($image_name) 
    {
        $image = ImageX::select('id')->where('image', $image_name)->first();
        if (!$image) return ['status' => 'not_used', 'issue' => 'not_found'];

        $model = DB::table('settings')
                    ->select('value', 'id')
                    ->where('slug', 'desktop-menu-designs')
                    ->first();

        if ($model != null) {
            $menu_items = json_decode($model->value, true); 
            if ($menu_items && count($menu_items) > 0) {
                $menu_item_images = array_column($menu_items, 'text', 'image');

                if (count($menu_item_images) > 0 && isset($menu_item_images[$image_name])) {
                    return [
                        'status' => 'used', 
                        'issue'  => 'Desktop Menu', 
                        'index'  => $model->id, 
                        'title'  => $menu_item_images[$image_name]
                    ];
                }
            }
        }
        
        $model = DB::table('settings')
                    ->select('value', 'id')
                    ->where('slug', 'mobile-menu-designs')
                    ->first();

        if ($model != null) {
            $menu_items = json_decode($model->value, true); 
            if ($menu_items && count($menu_items) > 0) {
                $menu_item_images = array_column($menu_items, 'text', 'image');

                if (count($menu_item_images) > 0 && isset($menu_item_images[$image_name])) {
                    return [
                        'status' => 'used', 
                        'issue'  => 'Mobile Menu', 
                        'index'  => $model->id, 
                        'title'  => $menu_item_images[$image_name]
                    ];
                }
            }
        }

        $model = DB::table('settings')
                    ->select('id')
                    ->where('slug', 'generic-meta-image')
                    ->where('value', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Web Settings', 
                'index'  => $model->id, 
                'title'  => 'generic meta image'
            ];
        }

        $model = DB::table('teams')
                    ->select('id', 'name')
                    ->where('image_id', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Team', 
                'index'  => $model->id, 
                'title'  => $model->name
            ];
        }

        $model = DB::table('testimonials')
                    ->select('id', 'name')
                    ->where('image_id', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Testimonial', 
                'index'  => $model->id, 
                'title'  => $model->name
            ];
        }

        $model = DB::table('sliders')
                    ->leftJoin('slider_items', 'sliders.id', '=', 'slider_items.slider_id')
                    ->select('sliders.id', 'sliders.name')
                    ->where('slider_items.image_id', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Slider', 
                'index'  => $model->id, 
                'title'  => $model->name
            ];
        }

        $model = DB::table('pages')
                    ->leftJoin('page_seos', 'pages.id', '=', 'page_seos.page_id')
                    ->select('pages.id', 'pages.name')
                    ->orWhere('page_seos.image_id', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Page', 
                'index'  => $model->id, 
                'title'  => $model->name
            ];
        }

        $model = DB::table('pages')
                    ->leftJoin('section_contents', 'pages.id', '=', 'section_contents.page_id')
                    ->leftJoin('image_contents', 'section_contents.id', '=', 'image_contents.section_id')
                    ->select('pages.id', 'pages.name')
                    ->orWhere('image_contents.image_id', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Page', 
                'index'  => $model->id, 
                'title'  => $model->name
            ];
        }

        $model = DB::table('pages')
                    ->leftJoin('section_contents', 'pages.id', '=', 'section_contents.page_id')
                    ->leftJoin('list_content_bodies', 'section_contents.id', '=', 'list_content_bodies.section_id')
                    ->leftJoin('image_list_content_bodies', 'list_content_bodies.id', '=', 'image_list_content_bodies.list_id')
                    ->select('pages.id', 'pages.name')
                    ->orWhere('image_list_content_bodies.image_id', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Page', 
                'index'  => $model->id, 
                'title'  => $model->name
            ];
        }

        $model = DB::table('pages')
                    ->leftJoin('section_contents', 'pages.id', '=', 'section_contents.page_id')
                    ->leftJoin('list_content_heads', 'section_contents.id', '=', 'list_content_heads.section_id')
                    ->leftJoin('image_list_content_heads', 'list_content_heads.id', '=', 'image_list_content_heads.list_id')
                    ->select('pages.id', 'pages.name')
                    ->orWhere('image_list_content_heads.image_id', $image->id)
                    ->first();

        if ($model != null) {
            return [
                'status' => 'used', 
                'issue'  => 'Page', 
                'index'  => $model->id, 
                'title'  => $model->name
            ];
        }

        return ['status' => 'not_used', 'issue' => ''];
    }
}