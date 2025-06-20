<?php

namespace App\Services\Addons\News;

use App\Models\Addons\News\NewsSeo;

class NewsSeoService
{
    public static function _storing($data, $id)
    {
        $seo = new NewsSeo();
        $seo->news_id          = $id;
        $seo->meta_title       = $data['meta_title'];
        $seo->meta_description = $data['meta_description'];
        $seo->meta_keywords    = $data['meta_keywords'];
        $seo->image_id         = $data['meta_image_id'] ?? 0;
        $seo->image_alt        = $data['image_alt'] ?? null;
        $seo->save();
    }

    public static function _updating($data, $id)
    {
        $seo = NewsSeo::where('news_id', $id)->first();
        $seo->meta_title       = $data['meta_title'];
        $seo->meta_description = $data['meta_description'];
        $seo->meta_keywords    = $data['meta_keywords'];
        $seo->image_id         = $data['meta_image_id'] ?? 0;
        $seo->image_alt        = $data['image_alt'] ?? null;
        $seo->update();
    }

    public static function _restoring($data, $id)
    {
        $seo = NewsSeo::where('news_id', $id)->first();
        $seo->meta_title       = $data->meta_title;
        $seo->meta_description = $data->meta_description;
        $seo->meta_keywords    = $data->meta_keywords;
        $seo->image_id         = $data->image_id;
        $seo->image_alt        = $data->image_alt;
        $seo->update();
    }

    public static function _deleting($id)
    {
        NewsSeo::where('news_id', $id)->delete();
    }
}