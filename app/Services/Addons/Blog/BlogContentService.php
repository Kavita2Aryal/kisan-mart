<?php

namespace App\Services\Addons\Blog;

use App\Models\Addons\Blog\BlogContent;

class BlogContentService
{
    public static function _storing($data, $id) 
    {
        if ($data != null) {
            foreach($data as $content) {
                if ($content != null) {
                    if (isset($content['description']) && $content['description'] != '') {
                        $batch[] = [
                            'blog_id'           => $id,
                            'display_type'      => 1,
                            'display_order'     => $content['display_order'],
                            'description'       => trim_description($content['description']),
                            'image_gallery'     => null,
                        ];
                    }
                    else if (isset($content['image_gallery']) && $content['image_gallery'] != '') {
                        $batch[] = [
                            'blog_id'           => $id,
                            'display_type'      => 2,
                            'display_order'     => $content['display_order'],
                            'description'       => '',
                            'image_gallery'     => json_encode($content['image_gallery'])
                        ];
                    }
                }
            }

            if (isset($batch) && !empty($batch)) {
                BlogContent::insert($batch);
            }
        }
    }

    public static function _restoring($data, $id) 
    {
        if ($data != null) {
            foreach($data as $content) {
                $batch[] = [
                    'blog_id'           => $id,
                    'display_type'      => $content->display_type,
                    'display_order'     => $content->display_order,
                    'description'       => $content->description,
                    'image_gallery'     => $content->image_gallery,
                ];
            }

            if (isset($batch) && !empty($batch)) {
                BlogContent::insert($batch);
            }
        }
    }

    public static function _deleting($id)
    {
        BlogContent::where('blog_id', $id)->delete();
    }
}