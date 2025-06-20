<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\SectionContent;
use App\Services\Cms\Page\SectionConfigService;
use App\Services\Cms\Page\SectionDescriptionService;
use App\Services\Cms\Page\TypeContentService;
use App\Services\Cms\Page\ImageContentService;
use App\Services\Cms\Page\SliderContentService;
use App\Services\Cms\Page\ListLinkService;
use App\Services\Cms\Page\ListVideoService;
use App\Services\Cms\Page\ListContentService;

class SectionContentService
{
    public static function _storing($data)
    {
        $content = new SectionContent(); 
        $content->section_name   = $data['name'];
        $content->page_id        = $data['page'];
        $content->config_id      = $data['config'];
        $content->display_order  = $data['display_order'];
        $content->is_active      = 0;
        $content->save();
    }

    public static function _updating($req, $uuid)
    {
        if ($content = SectionContent::where('uuid', $uuid)->first()) {
            $index = $req->index;

            $content->title     = $req->has('section.'.$index.'.title') ? $req->input('section.'.$index.'.title') : '';
            $content->subtitle  = $req->has('section.'.$index.'.subtitle') ? $req->input('section.'.$index.'.subtitle') : '';
            $content->is_active = $req->has('section.'.$index.'.is_active') ? 10 : 0;

            if ($content->update()) {
                
                self::_deleting($content->id);

                if ($req->has('section.'.$index.'.description')) {
                    SectionDescriptionService::_updating($req->input('section.'.$index.'.description'), $content->id);
                }

                if ($req->has('section.'.$index.'.list')) { 
                    ListContentService::_content_updating($req->input('section.'.$index.'.list'), $content->id);
                }                  

                if ($req->has('section.'.$index.'.slider')) { 
                    SliderContentService::_updating($req->input('section.'.$index.'.slider'), $content->id);
                }

                if ($req->has('section.'.$index.'.image')) { 
                    ImageContentService::_updating($req->input('section.'.$index.'.image'), $content->id);
                }

                if ($req->has('section.'.$index.'.link')) { 
                    ListLinkService::_updating($req->input('section.'.$index.'.link'), $content->id);
                }

                if ($req->has('section.'.$index.'.video')) { 
                    ListVideoService::_updating($req->input('section.'.$index.'.video'), $content->id);
                }

                if ($req->has('section.'.$index.'.type')) { 
                    TypeContentService::_updating($req->input('section.'.$index.'.type'), $content->id);
                }

                return true;
            }
        }
        return false;
    }

    public static function _deleting($content_id) 
    {
        SectionDescriptionService::_deleting($content_id);
        ImageContentService::_deleting($content_id);
        SliderContentService::_deleting($content_id);
        ListLinkService::_deleting($content_id);
        ListVideoService::_deleting($content_id);
        ListContentService::_content_deleting($content_id);
        TypeContentService::_deleting($content_id);
    }

    public static function _all_deleting($contents) 
    {
        foreach ($contents as $content) {
            SectionConfigService::_deleting($content->config_id);
            self::_deleting($content->id);
            $content->delete();
        }
    }
}
