<?php

namespace App\Services\Cms\Page;

use App\Services\Cms\Page\ListConfigHeadService;
use App\Services\Cms\Page\ListConfigBodyService;
use App\Services\Cms\Page\ListContentHeadService;
use App\Services\Cms\Page\ListContentBodyService;

class ListContentService
{
	public static function _config_updating($data, $config_id) 
	{
		foreach ($data as $list_key => $list_config) {
            if (isset($list_config['head'])) {
                $head_id = ListConfigHeadService::_storing($list_config['head'], $config_id); 
            }
            if (isset($list_config['body'])) {
                ListConfigBodyService::_storing($list_config['body'], $config_id, $head_id ?? 0); 
            }
        }
	}

    public static function _config_deleting($config_id) 
	{
		ListConfigHeadService::_deleting($config_id);
        ListConfigBodyService::_deleting($config_id);
	}

	public static function _content_updating($data, $section_id)
    { 
        if ($data != null) { 
            $group_id = 0;
            foreach ($data as $lists) { 
                $head_id = 0;
                if (isset($lists['head']) && $lists['head'] != null) { 
                    $head_id = ListContentHeadService::_storing($lists['head'], $lists['head_config'], $section_id);
                }
                if (isset($lists['body']) && $lists['body'] != null) { 
                    $group_id++;
                    ListContentBodyService::_storing($lists['body'], $lists['body_config'], $section_id, $head_id, $group_id);
                }
            }
        }
    }

    public static function _content_deleting($section_id)
    {
        ListContentHeadService::_deleting($section_id);
        ListContentBodyService::_deleting($section_id);
    }
}
