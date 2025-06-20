<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ListVideo;

class ListVideoService
{
    public static function _updating($list, $section_id)
    {
        if ($list != null) { 
            foreach ($list as $video) {
                if ($video != null) {
                    $batch[] = [
                        'title'              => $video['title'], 
                        'value'              => $video['value'],
                        'video_thumbnail_id' => $video['thumbnail'],
                        'section_id'         => $section_id
                    ];
                }
            }

            if (isset($batch) && !empty($batch)) {
                ListVideo::insert($batch);
            }
        }
    }

    public static function _deleting($section_id)
    {
        ListVideo::where('section_id', $section_id)->delete();
    }
}
