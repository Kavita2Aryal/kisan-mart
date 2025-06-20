<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ListContentBody;
use App\Services\Cms\Page\ImageListContentBodyService;

class ListContentBodyService
{
	public static function _storing($bodies, $list_config_id, $section_id, $head_id, $group_id)
    {
        foreach ($bodies as $body) {
            $list                  = new ListContentBody();
            $list->head_id         = $head_id;
            $list->group_id        = $group_id;
            $list->section_id      = $section_id;
            $list->list_config_id  = $list_config_id;
            $list->title           = $body['title'] ?? '';
            $list->subtitle        = $body['subtitle'] ?? '';
            $list->description     = trim_description($body['description'] ?? '');
            $list->icon            = $body['icon'] ?? '';
            $list->link_title      = $body['link_title'] ?? '';
            $list->link            = $body['link'] ?? '';
            $list->display_order   = $body['display_order'];

            if ($list->save()) {
                if (isset($body['image']) && $body['image'] != null) {
                    ImageListContentBodyService::_storing($body['image'], $list->id);
                }
            }
        }
    }

    public static function _deleting($section_id)
    {
        $bodies = ListContentBody::select(['id'])->where('section_id', $section_id);
        if ($list = $bodies->get()) {
        	ImageListContentBodyService::_deleting($list);
            $bodies->delete();
        }
    }
}