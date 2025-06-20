<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\ListConfigBody;

class ListConfigBodyService
{
	public static function _storing($list_config, $config_id, $head_id)
	{
		$body 				   = new ListConfigBody(); 
		$body->has_title       = $list_config['title'];
		$body->has_subtitle    = $list_config['subtitle'];
		$body->has_description = $list_config['description'];
		$body->has_image       = $list_config['image'];
		$body->has_link        = $list_config['link'];
		$body->has_icon        = $list_config['icon'];
		$body->no_of_images    = $list_config['no_of_images'];
		$body->head_id         = $head_id;
		$body->config_id       = $config_id;
		$body->save();
	}

	public static function _deleting($config_id) 
	{
		ListConfigBody::where('config_id', $config_id)->delete();
	}
}