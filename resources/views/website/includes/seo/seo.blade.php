@php

if($seo != null || $seo != '') {
$meta_image = secure_img($seo['meta_image'], '1200');
}else {
$meta_image = secure_img($settings['generic-meta-image'], '1200');
}
@endphp
<meta name="author" content="{{ $settings['site-title'] ?? env('APP_NAME') }}" />
<meta name="title" content="{{ $seo['meta_title'] ?? $settings['generic-meta-title'] }}" />
<meta name="description" content="{{ $seo['meta_description'] ?? $settings['generic-meta-description'] }}" />
<meta name="image" content="{{ $meta_image }}" />

<meta itemprop="name" content="{{ $seo['meta_title'] ?? $settings['generic-meta-title'] }}" />
<meta itemprop="description" content="{{ $seo['meta_description'] ?? $settings['generic-meta-description'] }}" />
<meta itemprop="image" content="{{ $meta_image }}" />

<meta property="og:type" content="website" />
<meta property="og:url" content="{{ $url }}" />
<meta property="og:title" content="{{ $seo['meta_title'] ?? $settings['generic-meta-title'] }}" />
<meta property="og:description" content="{{ $seo['meta_description'] ?? $settings['generic-meta-description'] }}" />
<meta property="og:image" content="{{ $meta_image }}" />
<meta property="og:image:alt" content="{{ $seo['image_alt'] ?? $settings['generic-meta-image-alt'] }}" />
<meta property="fb:app_id" content="{{ env('FACEBOOK_APP_ID') }}" />
<meta property="og:hashtag" content="{{ $seo['meta_keywords'] ?? $settings['generic-meta-keywords'] }}" />
<meta property="og:image:width" content="1200" />
<title>{{ $seo['meta_title'] ?? $settings['generic-meta-title'] ?? $settings['website-title'] ?? env('APP_NAME') }} | @yield('title') </title>