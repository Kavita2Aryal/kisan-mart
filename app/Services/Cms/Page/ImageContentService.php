<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ImageContent;

class ImageContentService
{
	public static function _updating($images, $section_id)
    {
        if ($images != null) { 
            $display_order = 0;
            foreach ($images as $image) { 
                if ($image != null) {
                    $display_order++;
                    $batch[] = [
                        'image_id'   => $image, 
                        'section_id' => $section_id,
                        'display_order' => $display_order
                    ];
                }
            }

            if (isset($batch) && !empty($batch)) {
                ImageContent::insert($batch);
            }
        }
    }

    public static function _deleting($section_id)
    {
        ImageContent::where('section_id', $section_id)->delete();
    }
}
