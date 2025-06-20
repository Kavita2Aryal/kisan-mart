<?php

namespace Database\Seeders\General;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting_batch = [
    		[
    			'name' 		=> 'maintenance mode',
    			'slug' 		=> 'maintenance-mode',
    			'value' 	=> 'OFF'
    		],
    		[
    			'name' 		=> 'website title',
    			'slug' 		=> 'website-title',
    			'value' 	=> 'KisanMart'
    		],
			[
    			'name' 		=> 'website domain',
    			'slug' 		=> 'website-domain',
    			'value' 	=> 'https://kisanmart.com.np/'
    		],
    		[
    			'name' 		=> 'admin email',
    			'slug' 		=> 'admin-email',
    			'value' 	=> 'info@kisanmart.com.np'
    		],
    		[
    			'name' 		=> 'noreply email',
    			'slug' 		=> 'noreply-email',
    			'value' 	=> 'noreply@kisanmart.com'
    		],
    		[
    			'name' 		=> 'generic meta use',
    			'slug' 		=> 'generic-meta-use',
    			'value' 	=> 'ON'
    		],
    		[
    			'name' 		=> 'generic meta image',
    			'slug' 		=> 'generic-meta-image',
    			'value' 	=> ''
    		],
    		[
    			'name' 		=> 'generic meta image alt',
    			'slug' 		=> 'generic-meta-image-alt',
    			'value' 	=> ''
    		],
    		[
    			'name' 		=> 'generic meta title',
    			'slug' 		=> 'generic-meta-title',
    			'value' 	=> 'KisanMart'
    		],
    		[
    			'name' 		=> 'generic meta keywords',
    			'slug' 		=> 'generic-meta-keywords',
    			'value' 	=> 'kisanmart, kisan, codes'
    		],
    		[
    			'name'	 	=> 'generic meta description',
    			'slug'	 	=> 'generic-meta-description',
    			'value' 	=> 'Kisanmart Pvt. Ltd.'
    		],
    		[
    			'name' 		=> 'contact title',
    			'slug' 		=> 'contact-title',
    			'value' 	=> 'KisanMart'
    		],
    		[
    			'name' 		=> 'contact phone',
    			'slug' 		=> 'contact-phone',
    			'value' 	=> '123456789'
    		],
    		[
    			'name' 		=> 'contact mobile',
    			'slug' 		=> 'contact-mobile',
    			'value' 	=> '123456789'
    		],
    		[
    			'name' 		=> 'contact email',
    			'slug' 		=> 'contact-email',
    			'value' 	=> 'info@kisanmart.com'
    		],
    		[
    			'name' 		=> 'contact address',
    			'slug' 		=> 'contact-address',
    			'value' 	=> 'Kathmandu, Nepal'
    		],
            [
				'name' 		=> 'mobile menu as desktop menu',
				'slug' 		=> 'mobile-menu-as-desktop-menu',
				'value' 	=> 'YES',
			],
			[
				'name' 		=> 'desktop menu designs',
				'slug' 		=> 'desktop-menu-designs',
				'value' 	=> '',
			],
			[
				'name' 		=> 'mobile menu designs',
				'slug' 		=> 'mobile-menu-designs',
				'value' 	=> '',
			],
			[
				'name' 		=> 'offer title',
				'slug' 		=> 'offer-title',
				'value' 	=> '',
			],
			[
				'name' 		=> 'offer link title',
				'slug' 		=> 'offer-link-title',
				'value' 	=> '',
			],
			[
				'name' 		=> 'offer link',
				'slug' 		=> 'offer-link',
				'value' 	=> '',
			],
			[
				'name' 		=> 'offer status',
				'slug' 		=> 'offer-status',
				'value' 	=> '',
			],
			[
				'name' 		=> 'vat rate',
				'slug' 		=> 'vat-rate',
				'value' 	=> '13',
			],
			[
				'name' 		=> 'vat applicable',
				'slug' 		=> 'vat-applicable',
				'value' 	=> 'OFF',
			],
			[
				'name' 		=> 'help title',
				'slug' 		=> 'help-title',
				'value' 	=> 'Need Help?',
			],
			[
				'name' 		=> 'help description',
				'slug' 		=> 'help-description',
				'value' 	=> 'The product will be delivered within 14-25 days after your order.',
			],
			[
				'name' 		=> 'help status',
				'slug' 		=> 'help-status',
				'value' 	=> 'ON',
			],
			[
				'name' 		=> 'delivery title',
				'slug' 		=> 'delivery-title',
				'value' 	=> 'Fast Delivery',
			],
			[
				'name' 		=> 'delivery description',
				'slug' 		=> 'delivery-description',
				'value' 	=> 'The product will be delivered within 14-25 days after your order.',
			],
			[
				'name' 		=> 'delivery status',
				'slug' 		=> 'delivery-status',
				'value' 	=> 'ON',
			],
			[
				'name' 		=> 'delivery partner title',
				'slug' 		=> 'delivery-partner-title',
				'value' 	=> 'Upaya Cargo',
			],
			[
				'name' 		=> 'delivery partner description',
				'slug' 		=> 'delivery-partner-description',
				'value' 	=> 'With the goal of promoting and supporting female employees.',
			],
			[
				'name' 		=> 'delivery partner status',
				'slug' 		=> 'delivery-partner-status',
				'value' 	=> 'ON',
			],
			[
				'name' 		=> 'made with love title',
				'slug' 		=> 'made-with-love-title',
				'value' 	=> 'Made With Love',
			],
			[
				'name' 		=> 'made with love description',
				'slug' 		=> 'made-with-love-description',
				'value' 	=> 'Aenean commodo ligula eget dolor aenean massa cum.',
			],
			[
				'name' 		=> 'made with love status',
				'slug' 		=> 'made-with-love-status',
				'value' 	=> 'ON',
			],
			[
				'name' 		=> 'happy customer title',
				'slug' 		=> 'happy-customer-title',
				'value' 	=> 'Happy Customer',
			],
			[
				'name' 		=> 'happy customer description',
				'slug' 		=> 'happy-customer-description',
				'value' 	=> 'Aenean commodo ligula eget dolor aenean massa cum.',
			],
			[
				'name' 		=> 'happy customer status',
				'slug' 		=> 'happy-customer-status',
				'value' 	=> 'ON',
			],
			[
				'name' 		=> 'popup display per session',
				'slug' 		=> 'popup-display-per-session',
				'value' 	=> 'ON',
			],
			[
				'name' 		=> 'popup display per session time',
				'slug' 		=> 'popup-display-per-session-time',
				'value' 	=> '2',
			],
			[
				'name' 		=> 'logo image',
				'slug' 		=> 'logo-image',
				'value' 	=> '',
			],
			[
				'name' 		=> 'favicon image',
				'slug' 		=> 'favicon-image',
				'value' 	=> '',
			],
			[
				'name' 		=> 'mailchimp status',
				'slug' 		=> 'mailchimp-status',
				'value' 	=> 'OFF',
			],
			[
				'name' 		=> 'hotjar status',
				'slug' 		=> 'hotjar-status',
				'value' 	=> 'OFF',
			],
			[
				'name' 		=> 'google analytics status',
				'slug' 		=> 'google-analytics-status',
				'value' 	=> 'OFF',
			],
			[
				'name' 		=> 'chatbot status',
				'slug' 		=> 'chatbot-status',
				'value' 	=> 'OFF',
			],
			[
				'name' 		=> 'third party status',
				'slug' 		=> 'third-party-status',
				'value' 	=> 'OFF',
			],
			[
				'name' 		=> 'hotjar embed',
				'slug' 		=> 'hotjar-embed',
				'value' 	=> '',
			],
			[
				'name' 		=> 'google analytics embed',
				'slug' 		=> 'google-analytics-embed',
				'value' 	=> '',
			],
			[
				'name' 		=> 'chatbot embed',
				'slug' 		=> 'chatbot-embed',
				'value' 	=> '',
			],
			[
				'name' 		=> 'third party embed',
				'slug' 		=> 'third-party-embed',
				'value' 	=> '',
			],
			[
				'name' 		=> 'payment options',
				'slug' 		=> 'payment-options',
				'value' 	=> 'CASH ON DELIVERY, FONEPAY',
			]

    	];

		data_fill($setting_batch, '*.user_id', 1);
		data_fill($setting_batch, '*.is_active', 10);
		data_fill($setting_batch, '*.created_at', now()->toDateTimeString());
		data_fill($setting_batch, '*.updated_at', now()->toDateTimeString());

    	DB::table('settings')->insert($setting_batch);
    }
}
