<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\SectionConfig;
use App\Models\Cms\Page\SectionContent;

use App\Services\Cms\Page\SectionContentService;
use App\Services\Cms\Page\ListContentService;
use App\Services\Cms\Page\TypeConfigService;

class SectionConfigService
{
	public static function _storing($req, $page)
    {
        if ($req->has('sections')) {
            $sections = $req->input('sections');
            $config_sections = get_section_config();
            
            foreach ($sections as $row) {
                $section = $config_sections[$row['index']];

                $config = new SectionConfig(); 
                $config->section_name        = $page->name . ' section ' . $row['display_order'];
                $config->section_index       = $row['index'];
                $config->section_filename    = $section['filename'];
                $config->has_title           = $section['config']['title'];
                $config->has_subtitle        = $section['config']['subtitle'];
                $config->has_description     = $section['config']['description'];
                $config->has_image           = $section['config']['image'];
                $config->has_slider          = $section['config']['slider'];
                $config->has_link            = $section['config']['link'];
                $config->has_video           = $section['config']['video'];
                $config->has_type            = $section['config']['type'];
                $config->has_list            = $section['config']['list'];
                $config->no_of_images        = $section['config']['no_of_images'];
                $config->no_of_sliders       = $section['config']['no_of_sliders'];
                $config->no_of_videos        = $section['config']['no_of_videos'];
            
                if ($config->save()) {  

                    $content = [
                        'display_order' => $row['display_order'],
                        'config' => $config->id,
                        'name' => $config->section_name,
                        'page' => $page->id
                    ];
                    SectionContentService::_storing($content);

                    if (isset($section['list_config']) && $section['list_config'] != '') {
                        ListContentService::_config_updating($section['list_config'], $config->id);
                    }
                    
                    if (isset($section['type_config']) && $section['type_config'] != '') {
                        TypeConfigService::_updating($section['type_config'], $config->id);
                    }
                }
            }
        }
    }

    public static function _updating($req, $page)
    {
        $old_sections = array_column($page->section_contents->toArray(), 'id');
        if ($req->has('pre_sections')) {
            $pre_sections = $req->input('pre_sections');

            $remaining_old_sections = array_column($pre_sections, 'id');
            $deletable_old_sections = array_diff($old_sections, $remaining_old_sections);  

            foreach ($pre_sections as $remaining) { 
                if ($content = SectionContent::find($remaining['id']) ) {
                    $content->section_name  = $page->name . ' section ' . $remaining['display_order'];
                    $content->display_order = $remaining['display_order'];
                    $content->update();

                    if ($config = SectionConfig::find($content->config_id)) {
                        $config->section_name = $content->section_name;
                        $config->update();
                    }
                }
            }

            self::_all_deleting($deletable_old_sections);
        }
        else {
            self::_all_deleting($old_sections);
        }

        self::_storing($req, $page);
    }

    public static function _all_deleting($contents)
    {
        foreach ($contents as $content_id) {
            if ($content = SectionContent::find($content_id)) { 
                $content_id = $content->id;
                $config_id  = $content->config_id;
                
                if ($content->delete()) {
                    SectionConfig::find($config_id)->delete();
                    ListContentService::_config_deleting($config_id);
                    TypeConfigService::_deleting($config_id);
                    SectionContentService::_deleting($content_id);   
                }
            }
        }
    }

    public static function _deleting($config_id)
    {
        SectionConfig::find($config_id)->delete();
        ListContentService::_config_deleting($config_id);
        TypeConfigService::_deleting($config_id);
    }
}
