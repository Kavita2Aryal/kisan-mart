<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\SectionDescription;

class SectionDescriptionService
{
    public static function _updating($descriptions, $section_id) 
    {
        if ($descriptions != null) { 
            foreach ($descriptions as $description) {
                if ($description != null) { 
                    $batch[] = [
                        'section_id'  => $section_id,
                        'description' => trim_description($description),
                    ];
                }
            }

            if (isset($batch) && !empty($batch)) { 
                SectionDescription::insert($batch);
            }
        }
    }

    public static function _deleting($section_id)
    {
        SectionDescription::where('section_id', $section_id)->delete();
    }
}
