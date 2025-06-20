<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ListLink;

class ListLinkService
{
    public static function _updating($list, $section_id)
    {
        if ($list != null) { 
            foreach ($list as $link) {
                if ($link != null) {
                    $batch[] = [
                        'title'         => $link['title'], 
                        'value'         => $link['link'],
                        'display_type'  => 0, //$link['display_type'],
                        'display_order' => $link['display_order'],
                        'section_id'    => $section_id
                    ];
                }
            }

            if (isset($batch) && !empty($batch)) {
                ListLink::insert($batch);
            }
        }
    }

    public static function _deleting($section_id)
    {
        ListLink::where('section_id', $section_id)->delete();
    }
}
