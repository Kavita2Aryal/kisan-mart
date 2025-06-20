<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ListContentHead;
use App\Services\Cms\Page\ImageListContentHeadService;

class ListContentHeadService
{
    public static function _storing($head, $list_config_id, $section_id)
    {
        $list                  = new ListContentHead();
        $list->section_id      = $section_id;
        $list->list_config_id  = $list_config_id;
        $list->title           = $head['title'] ?? '';
        $list->subtitle        = $head['subtitle'] ?? '';
        $list->description     = trim_description($head['description'] ?? '');
        $list->link_title      = $head['link_title'] ?? '';
        $list->link            = $head['link'] ?? '';
        
        if ($list->save()) {
            if (isset($head['image']) && $head['image'] != null) {
                ImageListContentHeadService::_storing($head['image'], $list->id);
            }
            return $list->id;
        }
        return 0;
    }

	public static function _deleting($section_id)
    {
        $heads = ListContentHead::select(['id'])->where('section_id', $section_id);
        if ($list = $heads->get()) {
            ImageListContentHeadService::_deleting($list);
            $heads->delete();
        }
    }
}