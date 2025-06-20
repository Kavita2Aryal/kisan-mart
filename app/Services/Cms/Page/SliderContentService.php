<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\SliderContent;

class SliderContentService
{
    public static function _updating($sliders, $section_id)
    {
        if ($sliders != null) { 
            foreach ($sliders as $slider) {
                if ($slider != null) {
                    $batch[] = [
                        'slider_id'  => $slider, 
                        'section_id' => $section_id
                    ];
                }
            }

            if (isset($batch) && !empty($batch)) { 
                SliderContent::insert($batch);
            }
        }
    }

    public static function _deleting($section_id)
    {
        SliderContent::where('section_id', $section_id)->delete();
    }
}
