<?php

return [
    'domain'        => 'http://127.0.0.1:8001/',
    'website'       => 'http://127.0.0.1:8000/',
    'cipher'        => 'AES-256-CBC',
    'key'           => 'KoN74>O,5Zd98t}t1<,5nSmL<^0[~:R[',

    'start_year'    => '2018',
    'cms_page_type'     => 'FULL',  // FULL or MINI
    'cms_page_add'      => 'YES',   // YES or NO
    'cms_mode'          => 'DEV',   // DEV or PROD
    
    'mini_cms_sections' => [        // edit here to make life easy
        'header' => 1,
        'footer' => 1,
        'sections' => [1, 3, 5]
    ],

    'session_time_options' => [        // edit here to make life easy
        1 => '1 hour',
        2 => '3 hours',
        3 => '6 hours',
        4 => '12 hours',
        5 => '24 hours',
    ],

    'list_group_types' => [
        'only_value' => 'List only has VALUE column', 
        'title_value' => 'List has TITLE & VALUE columns'
    ],

    'payment_response_encrypt_value'  => '45e7b37255885bd40c6ae9aa223a15f9',  //MD5 hash value
    'payment_url_default_expiry_time' => '1440',   //1 day period in minutes

    'image_min_width' => 100,
    'image_min_height' => 100,

    'product_min_width' => 1024,

    'maximu_order_quantity' => 10,

    'months' => [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ],

    'grid_nav' => [
        'general' => [
            'dashboard',
            'help',
            'logs',
            'setting',
            'profile',
            'user',
            'role',
        ],
        'cms' => [
            'page',
            'menu',
            'media',
            'slider',
            'popup',
            'web-alias',
        ],
        'build' => [
            'list-group',
            'section-config',
        ],
        'addons' => [
            'contacts',
            'newsletters',
            'quick-link',
            'social-media',
            'faq',
            'team',
            'testimonial',
            'partner',
            'blog',
            'author',
        ],
        'ecommerce' => [
            'order',
            'custom-order',
            'product',
            'category',
            'brand',
            'collection',
            'offer',
            'promocode',
            'currency',
            'country',
            'region',
            'city',
            'area',
            'color',
            'color-group',
            'size',
        ],
    ],
    
    'image_cache' => [
        'SIGNATURE' => '2fe5721ca33dd8ac391399d45986ba9f1d563e14dcd4c6a82197bf5ca2b9ee5613c852a615c516e717ee8fd4f8cf346896b49fdc6555e9818016c9ea2e66746bd0c93b90d1cf2c4aac8b8e1d89605b840a92023ecd1dc9c0858061664881882f0495686f525f22b940fa7eec6884c2497de449a0ba50b6ccd96f68318d41744c870d8a8d64be90c185d8ada204ffbbe45e5716f152a651a3cd612270c1a549352a8a890bec8e3ef0dae93a491054e9f1dda0382b0b73ef42a902733d90677aba51fd639b5effcc7bf4260855e9d8c2d4d3ea1817512a4fd281a6b32bcd86e07493bfe8288a76bda4e0ef85135b9a9595e5247c2f42ebc5152a2acc65711280609c57d727f8bf77a795f315bab248db950f03cac6c92cb78a1b21cd9d7219910e2d048cf161872338f0b322a0b58305749bc01368117310d15f9d8c78bd33dc6a',
        'SOURCE' => 'http://127.0.0.1:8001',
        'URL' => '/image-cache/',
        'PATH' => '/media/',
        'URL_SECTION' => '/section-cache/',
        'PATH_SECTION' => '/cms/section/',
        'URL_ECOM' => '/ecommerce-cache/',
        'PATH_ECOM' => '/ecommerce/',
        'URL_PRODUCT' => '/product-cache/',
        'PATH_PRODUCT' => '/product/',
        'CACHE_PATH' => 'public/.cache'
    ],

    'cache' => [
        '15MIN' => '900',
        '1HR' => '3600',
        '3HR' => '10800',
        '24HR' => '86400'
    ],

    'system' => [
        'name' => 'Kisan Mart',
        'version' => 'V2.7',
        'developer' => 'Kisan Mart',
        'company' => 'Kisan Mart Pvt. Ltd.',
        'website' => 'https://kisanmart.com',
        'email' => 'info@kisanmart.com',
    ],

    'mailchimp' => [
        'mailchimp_api_key' => "14f7dad8ff14ddab123d83fa11d635bb-us18",
        'mailchimp_server_prefix' => "us18",
        'mailchimp_list_id' => "feebececc1"
    ]
];