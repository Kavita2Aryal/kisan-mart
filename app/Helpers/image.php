<?php

use League\Glide\Urls\UrlBuilderFactory;

if (!function_exists('secure_img')) {
    function secure_img($path, $preset, $extra = [])
    {
        $img_check = explode('.', $path);
        if (is_array($img_check)) {
            if (in_array(end($img_check), ['gif', 'svg'])) {
                return config('app.config.image_cache.SOURCE').'/storage'.config('app.config.image_cache.PATH').$path;
            }
        }

        $urlBuilder = UrlBuilderFactory::create(config('app.config.image_cache.URL'), config('app.config.image_cache.SIGNATURE'));
        return config('app.config.image_cache.SOURCE') . $urlBuilder->getUrl($path, array_merge(['p' => $preset], $extra));
    }
}

if (!function_exists('secure_img_section')) {
    function secure_img_section($path, $preset, $extra = [])
    {
        $img_check = explode('.', $path);
        if (is_array($img_check)) {
            if (in_array(end($img_check), ['gif', 'svg'])) {
                return config('app.config.image_cache.SOURCE').'/storage'.config('app.config.image_cache.PATH_SECTION').$path;
            }
        }

        $urlBuilder = UrlBuilderFactory::create(config('app.config.image_cache.URL_SECTION'), config('app.config.image_cache.SIGNATURE'));
        return config('app.config.image_cache.SOURCE') . $urlBuilder->getUrl($path, array_merge(['p' => $preset], $extra));
    }
}

if (!function_exists('secure_img_ecom')) {
    function secure_img_ecom($path, $preset, $extra = [])
    {
        $img_check = explode('.', $path);
        if (is_array($img_check)) {
            if (in_array(end($img_check), ['gif', 'svg'])) {
                return config('app.config.image_cache.SOURCE').'/storage'.config('app.config.image_cache.PATH_ECOM').$path;
            }
        }

        $urlBuilder = UrlBuilderFactory::create(config('app.config.image_cache.URL_ECOM'), config('app.config.image_cache.SIGNATURE'));
        return config('app.config.image_cache.SOURCE') . $urlBuilder->getUrl($path, array_merge(['p' => $preset], $extra));
    }
}

if (!function_exists('secure_img_product')) {
    function secure_img_product($path, $preset, $extra = [])
    {
        $img_check = explode('.', $path);
        if (is_array($img_check)) {
            if (in_array(end($img_check), ['gif', 'svg'])) {
                return config('app.config.image_cache.SOURCE').'/storage'.config('app.config.image_cache.PATH_PRODUCT').$path;
            }
        }

        $urlBuilder = UrlBuilderFactory::create(config('app.config.image_cache.URL_PRODUCT'), config('app.config.image_cache.SIGNATURE'));
        return config('app.config.image_cache.SOURCE') . $urlBuilder->getUrl($path, array_merge(['p' => $preset], $extra));
    }
}
