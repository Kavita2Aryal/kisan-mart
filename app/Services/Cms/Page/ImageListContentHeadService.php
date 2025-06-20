<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ImageListContentHead;

class ImageListContentHeadService
{
    public static function _storing($images, $list_id)
    {
        if ($images != null) { 
            $display_order = 0;
            foreach ($images as $image) {
                if ($image > 0) {
                    $display_order++;
                    $batch[] = [
                        'list_id'  => $list_id,
                        'image_id' => $image,
                        'display_order' => $display_order
                    ];
                }
            }
            if (isset($batch) && !empty($batch)) {
                ImageListContentHead::insert($batch);
            }
        }
    }

    public static function _deleting($list)
    {
        ImageListContentHead::whereIn('list_id', $list->pluck('id')->toArray())->delete();
    }
}
