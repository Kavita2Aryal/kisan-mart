<?php

namespace Database\Seeders\Build;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ListGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            [
    			'name' 		=> 'Product Type',
    			'slug' 		=> 'product-type',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Ready Made', 
                        'value' => '1'
                    ],
                    [
                        'title' => 'Custom Made', 
                        'value' => '2'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Order Status',
    			'slug' 		=> 'order-status',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Error', 
                        'value' => '0'
                    ],
                    [
                        'title' => 'Pending', 
                        'value' => '1'
                    ],
                    [
                        'title' => 'Cancelled', 
                        'value' => '2'
                    ],
                    [
                        'title' => 'Confirmed', 
                        'value' => '3'
                    ],
                    [
                        'title' => 'Shipped', 
                        'value' => '4'
                    ],
                    [
                        'title' => 'Delivered', 
                        'value' => '5'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Order Status Save',
    			'slug' 		=> 'order-status-save',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => '0', 
                        'value' => 'error'
                    ],
                    [
                        'title' => '1', 
                        'value' => 'pending'
                    ],
                    [
                        'title' => '2', 
                        'value' => 'cancelled'
                    ],
                    [
                        'title' => '3', 
                        'value' => 'confirmed'
                    ],
                    [
                        'title' => '4', 
                        'value' => 'shipped'
                    ],
                    [
                        'title' => '5', 
                        'value' => 'delivered'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Offer Discount Type',
    			'slug' 		=> 'offer-discount-type',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Flat', 
                        'value' => '1'
                    ],
                    [
                        'title' => 'UpTo', 
                        'value' => '2'
                    ],
                    [
                        'title' => 'MoreThan', 
                        'value' => '3'
                    ]
                ])
    		],
            [
    			'name' 		=> 'Discount Type',
    			'slug' 		=> 'discount-type',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Percentage', 
                        'value' => '1'
                    ],
                    [
                        'title' => 'Amount', 
                        'value' => '2'
                    ]
                ])
    		],
            [
    			'name' 		=> 'Collection Type',
    			'slug' 		=> 'collection-type',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Collection', 
                        'value' => '1'
                    ],
                    [
                        'title' => 'New Arrival', 
                        'value' => '2'
                    ],
                    [
                        'title' => 'Promotion', 
                        'value' => '3'
                    ],
                    [
                        'title' => 'Occasion', 
                        'value' => '4'
                    ]
                ])
    		],
            [
    			'name' 		=> 'Body Measurement',
    			'slug' 		=> 'body-measurement',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Length', 
                        'value' => '1'
                    ],
                    [
                        'title' => 'Shoulder', 
                        'value' => '2'
                    ],
                    [
                        'title' => 'Armhole', 
                        'value' => '3'
                    ],
                    [
                        'title' => 'Chest', 
                        'value' => '4'
                    ],
                    [
                        'title' => 'Waist', 
                        'value' => '5'
                    ],
                    [
                        'title' => 'Hip', 
                        'value' => '6'
                    ],
                    [
                        'title' => 'Brust', 
                        'value' => '7'
                    ],
                    [
                        'title' => 'Sleeve', 
                        'value' => '8'
                    ],
                    [
                        'title' => 'Round', 
                        'value' => '9'
                    ],
                    [
                        'title' => 'Neck', 
                        'value' => '10'
                    ],
                    [
                        'title' => 'Front', 
                        'value' => '11'
                    ],
                    [
                        'title' => 'Back', 
                        'value' => '12'
                    ],
                    [
                        'title' => 'Pant', 
                        'value' => '13'
                    ],
                    [
                        'title' => 'Low', 
                        'value' => '14'
                    ],
                    [
                        'title' => 'Thigh', 
                        'value' => '15'
                    ],
                    [
                        'title' => 'Knee', 
                        'value' => '16'
                    ],
                    [
                        'title' => 'Ancle', 
                        'value' => '17'
                    ],
                    [
                        'title' => 'Round', 
                        'value' => '18'
                    ],
                    [
                        'title' => 'Half', 
                        'value' => '19'
                    ],
                    [
                        'title' => 'Crotch', 
                        'value' => '20'
                    ],
                    [
                        'title' => 'Fair', 
                        'value' => '21'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Payment Status',
    			'slug' 		=> 'payment-status',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => 'Due', 
                        'value' => '0'
                    ],
                    [
                        'title' => 'Fully Paid', 
                        'value' => '1'
                    ],
                    [
                        'title' => 'Partially Paid', 
                        'value' => '2'
                    ],
                ])
    		],
            [
    			'name' 		=> 'Payment Status Save',
    			'slug' 		=> 'payment-status-save',
                'uuid'      => Str::uuid()->toString(),
                'list_type' => 'title_value',
    			'items' 	=> json_encode([
                    [
                        'title' => '0', 
                        'value' => 'due'
                    ],
                    [
                        'title' => '1', 
                        'value' => 'fully-paid'
                    ],
                    [
                        'title' => '2', 
                        'value' => 'partially-paid'
                    ],
                ])
    		],
    	];

		data_fill($list_group_batch, '*.user_id', 1);
		data_fill($list_group_batch, '*.created_at', now()->toDateTimeString());
		data_fill($list_group_batch, '*.updated_at', now()->toDateTimeString());

    	DB::table('list_groups')->insert($list_group_batch);
    }
}
