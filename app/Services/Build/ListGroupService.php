<?php

namespace App\Services\Build;

use App\Models\Build\ListGroup;
use Illuminate\Support\Str;

class ListGroupService
{
    public static function _find($uuid)
    {
        return ListGroup::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return ListGroup::all();
    }

    public static function _storing($req)       
    {
        $list_group = new ListGroup();
        $list_group->name      = $req->name;
        $list_group->slug      = $req->slug;
        $list_group->list_type = $req->list_type;
        $list_group->items     = json_encode(array_values($req->items));

        return $list_group->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $list_group = self::_find($uuid);
        if (!$list_group) return false;

        $list_group->name  = $req->name;
        $list_group->items = json_encode(array_values($req->items));

        return $list_group->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $list_group = self::_find($uuid);
        if (!$list_group) return false;
        
        return $list_group->delete() ? true : false;
    }

    public static function _get_data($slug)
	{
		$list_groups = self::_init();
		return $list_groups[$slug] ?? null;
	}

	public static function _init()
	{
		return cache()->remember('list_group_cache', config('app.config.cache.24HR'), function () {
            $list_groups = ListGroup::select('slug', 'items', 'list_type')->get()->toArray();
			$list_groups = array_map(function ($list) {
                $items = json_decode($list['items'], true);
                if ($items != null) {
                    $items = $list['list_type'] == 'title_value' 
                                ? array_column($items, 'title', 'value') 
                                : array_column($items, 'value');
                }
                return ['items' => $items, 'slug' => $list['slug']];
            }, $list_groups);
            return array_column($list_groups, 'items', 'slug');
        });
	}

    public static function _reset() 
    {
    	ListGroup::whereNotNull('id')->delete();

        $list_group_batch = [
    		[
    			'name' 		=> 'Type Contents',
    			'slug' 		=> 'type_contents',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'contact_form', 
                        'value' => 1
                    ],
                    [
                        'title' => 'faq', 
                        'value' => 2
                    ],
                    [
                        'title' => 'team', 
                        'value' => 3
                    ],
                    [
                        'title' => 'testimonial', 
                        'value' => 4
                    ],
                    [
                        'title' => 'blogs', 
                        'value' => 5
                    ],
                    [
                        'title' => 'events', 
                        'value' => 6
                    ],
                    [
                        'title' => 'news', 
                        'value' => 7
                    ],
                    [
                        'title' => 'partners', 
                        'value' => 8
                    ],
                    [
                        'title' => 'popups', 
                        'value' => 9
                    ],
                    [
                        'title' => 'quick_links', 
                        'value' => 10
                    ],
                    [
                        'title' => 'social_media', 
                        'value' => 11
                    ]
                ])
    		],
            [
    			'name' 		=> 'Website Style Sheets',
    			'slug' 		=> 'website_styles',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'website-static-path-to-slick-css', 
                        'value' => 1
                    ],
                    [
                        'title' => 'cdn-path-to-datepicker-css', 
                        'value' => 2
                    ]
                ])
    		],
            [
    			'name' 		=> 'Website Javascripts',
    			'slug' 		=> 'website_scripts',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'website-static-path-to-slick-js', 
                        'value' => 1
                    ],
                    [
                        'title' => 'cdn-path-to-datepicker-js', 
                        'value' => 2
                    ]
                ])
    		],
            [
    			'name' 		=> 'Website Headers',
    			'slug' 		=> 'website_headers',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'header_1.jpg', 
                        'value' => 1
                    ],
                    [
                        'title' => 'header_2.jpg', 
                        'value' => 2
                    ],
                ])
    		],
            [
    			'name' 		=> 'Website Footers',
    			'slug' 		=> 'website_footers',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'footer_1.jpg', 
                        'value' => 1
                    ],
                    [
                        'title' => 'footer_2.jpg', 
                        'value' => 2
                    ],
                ])
    		],
            [
    			'name' 		=> 'Section Filters',
    			'slug' 		=> 'section_filters',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Title', 
                        'value' => '.has-title'
                    ],
                    [
                        'title' => 'Subtitle', 
                        'value' => '.has-subtitle'
                    ],
                    [
                        'title' => 'Descriptions', 
                        'value' => '.has-description'
                    ],
                    [
                        'title' => 'Images', 
                        'value' => '.has-image'
                    ],
                    [
                        'title' => 'Sliders', 
                        'value' => '.has-slider'
                    ],
                    [
                        'title' => 'Lists', 
                        'value' => '.has-list'
                    ],
                    [
                        'title' => 'Links', 
                        'value' => '.has-link'
                    ],
                    [
                        'title' => 'Videos', 
                        'value' => '.has-video'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Quick Link Groups',
    			'slug' 		=> 'quick_link_groups',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Default', 
                        'value' => 1
                    ],
                ])
    		],
            [
    			'name' 		=> 'Team Groups',
    			'slug' 		=> 'team_groups',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Default', 
                        'value' => 1
                    ],
                ])
    		],
            [
    			'name' 		=> 'Social Media',
    			'slug' 		=> 'social_media',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => '<i>facebook</i>', 
                        'value' => 'facebook'
                    ],
                    [
                        'title' => '<i>instagram</i>', 
                        'value' => 'instagram'
                    ],
                    [
                        'title' => '<i>linkedin</i>', 
                        'value' => 'linkedin'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Icons',
    			'slug' 		=> 'icons',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'NO ICON', 
                        'value' => 'no-icon'
                    ],
                    [
                        'title' => 'icon: home;', 
                        'value' => 'thundericon-home'
                    ],
                    [
                        'title' => 'icon: question;', 
                        'value' => 'thundericon-question'
                    ],
                    [
                        'title' => 'icon: camera;', 
                        'value' => 'thundericon-camera'
                    ],
                    [
                        'title' => 'icon: video-camera;', 
                        'value' => 'thundericon-video-camera'
                    ],
                    [
                        'title' => 'icon: bell;', 
                        'value' => 'thundericon-bell'
                    ],
                    [
                        'title' => 'icon: user;', 
                        'value' => 'thundericon-user'
                    ],
                    [
                        'title' => 'icon: users;', 
                        'value' => 'thundericon-users'
                    ],
                    [
                        'title' => 'icon: lock;', 
                        'value' => 'thundericon-lock'
                    ],
                    [
                        'title' => 'icon: unlock;', 
                        'value' => 'thundericon-unlock'
                    ],
                    [
                        'title' => 'icon: bolt;', 
                        'value' => 'thundericon-bolt'
                    ],
                    [
                        'title' => 'icon: heart;', 
                        'value' => 'thundericon-heart'
                    ],
                    [
                        'title' => 'icon: cog;', 
                        'value' => 'thundericon-cog'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Social Icons',
    			'slug' 		=> 'social_icons',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'icon: facebook;', 
                        'value' => 'thundericon-facebook'
                    ],
                    [
                        'title' => 'icon: twitter;', 
                        'value' => 'thundericon-twitter'
                    ],
                    [
                        'title' => 'icon: instagram;', 
                        'value' => 'thundericon-instagram'
                    ],
                    [
                        'title' => 'icon: youtube;', 
                        'value' => 'thundericon-youtube'
                    ],
                    [
                        'title' => 'icon: whatsapp;', 
                        'value' => 'thundericon-whatsapp'
                    ],
                    [
                        'title' => 'icon: linkedin;', 
                        'value' => 'thundericon-linkedin'
                    ],
                    [
                        'title' => 'icon: pinterest;', 
                        'value' => 'thundericon-pinterest'
                    ],
                    [
                        'title' => 'icon: reddit;', 
                        'value' => 'thundericon-reddit'
                    ],
                    [
                        'title' => 'icon: tripadvisor;', 
                        'value' => 'thundericon-tripadvisor'
                    ],
                    [
                        'title' => 'icon: google;', 
                        'value' => 'thundericon-google'
                    ],
                    [
                        'title' => 'icon: tumblr;', 
                        'value' => 'thundericon-tumblr'
                    ],
                    [
                        'title' => 'icon: dribbble;', 
                        'value' => 'thundericon-dribbble'
                    ],
                    [
                        'title' => 'icon: 500px;', 
                        'value' => 'thundericon-500px'
                    ],
                    [
                        'title' => 'icon: vimeo;', 
                        'value' => 'thundericon-vimeo'
                    ],
                    [
                        'title' => 'icon: yelp;', 
                        'value' => 'thundericon-yelp'
                    ],
                    [
                        'title' => 'icon: soundcloud;', 
                        'value' => 'thundericon-soundcloud'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Custom Icons',
    			'slug' 		=> 'custom_icons',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> NULL
    		],
            [
    			'name' 		=> 'Default Pages',
    			'slug' 		=> 'default_pages',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Home Page', 
                        'value' => '/'
                    ],
                    [
                        'title' => 'Maintenance Page', 
                        'value' => 'maintenance'
                    ],
                ])
    		],
    	];

		data_fill($list_group_batch, '*.user_id', 1);
		data_fill($list_group_batch, '*.created_at', now()->toDateTimeString());
		data_fill($list_group_batch, '*.updated_at', now()->toDateTimeString());

    	ListGroup::insert($list_group_batch);
    }
}