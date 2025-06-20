<?php

namespace App\Services\Addons\Blog;

use App\Models\Addons\Blog\BlogSeo;

class BlogSeoService
{
    public static function _storing($data, $id)
    {
        $seo = new BlogSeo();
        $seo->blog_id          = $id;
        $seo->meta_title       = $data['meta_title'];
        $seo->meta_description = $data['meta_description'];
        $seo->meta_keywords    = $data['meta_keywords'];
        $seo->image_id         = $data['meta_image_id'] ?? 0;
        $seo->image_alt        = $data['image_alt'] ?? null;
        $seo->save();
    }

    public static function _updating($data, $id)
    {
        $seo = BlogSeo::where('blog_id', $id)->first();
        $seo->meta_title       = $data['meta_title'];
        $seo->meta_description = $data['meta_description'];
        $seo->meta_keywords    = $data['meta_keywords'];
        $seo->image_id         = $data['meta_image_id'] ?? 0;
        $seo->image_alt        = $data['image_alt'] ?? null;
        $seo->update();
    }

    public static function _restoring($data, $id)
    {
        $seo = BlogSeo::where('blog_id', $id)->first();
        $seo->meta_title       = $data->meta_title;
        $seo->meta_description = $data->meta_description;
        $seo->meta_keywords    = $data->meta_keywords;
        $seo->image_id         = $data->image_id;
        $seo->image_alt        = $data->image_alt;
        $seo->update();
    }

    public static function _deleting($id)
    {
        BlogSeo::where('blog_id', $id)->delete();
    }
}