<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\PageSeo;

class PageSeoService
{
    public static function _storing($data, $page_id)
    {
        $seo                    = new PageSeo();
        $seo->page_id           = $page_id;
        $seo->meta_title        = $data['meta_title'];
        $seo->meta_description  = $data['meta_description'];
        $seo->meta_keywords     = $data['meta_keywords'];
        $seo->image_id          = $data['meta_image'] ?? 0;
        $seo->image_alt         = $data['image_alt'] ?? null;
        $seo->save();
    }

    public static function _updating($data, $page_id)
    {
        $seo = PageSeo::where('page_id', $page_id)->first();
        $seo->meta_title        = $data['meta_title'];
        $seo->meta_description  = $data['meta_description'];
        $seo->meta_keywords     = $data['meta_keywords'];
        $seo->image_id          = $data['meta_image'] ?? 0;
        $seo->image_alt         = $data['image_alt'] ?? null;
        $seo->update();
    }

    public static function _deleting($page_id)
    {
        PageSeo::where('page_id', $page_id)->delete();
    }
}