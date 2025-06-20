<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ListConfigHead;

class ListConfigHeadService
{
	public static function _storing($list_config, $config_id)
	{
		$head 				   = new ListConfigHead(); 
		$head->has_title       = $list_config['title'];
		$head->has_subtitle    = $list_config['subtitle'];
		$head->has_description = $list_config['description'];
		$head->has_image       = $list_config['image'];
		$head->has_link        = $list_config['link'];
		$head->no_of_images    = $list_config['no_of_images'];
		$head->config_id       = $config_id;
		$head->save();
		
		return $head->id;
	}

	public static function _deleting($config_id) 
	{
		ListConfigHead::where('config_id', $config_id)->delete();
	}
}