<?php

namespace App\Services\General;

use App\Models\General\Setting;
use App\Models\Cms\ImageX;

class SettingService
{
	public static function _meta_image($id)
	{
		if ($id > 0 && $img = ImageX::select('image')->find($id)) {
			return $img->image;
		}
		return null;
	}

	public static function _images($images)
	{
		if (count($images) > 0 && is_array($images)) {
			if ($data = ImageX::select('image', 'id')->whereIn('id', $images)->pluck('image', 'id')->toArray()) {
				foreach ($images as $key => $image) {
					$img[$key] = $data[$image] ?? null;
				}
				return $img;
			}
		}
		return null;
	}

	public static function _update($req)
	{
		$settings = $req->only('setting');
		if (isset($settings['setting']['isrequired'])) {
			foreach ($settings['setting']['isrequired'] as $slug => $value) {
				$value = $value != null ? $value : '';
				if ($setting = Setting::where('slug', $slug)->first()) {
					$setting->update(['value' => $value]);
				}
			}
		}
		if (isset($settings['setting']['notrequired'])) {
			foreach ($settings['setting']['notrequired'] as $slug => $value) {
				$value = $value != null ? $value : '';
				if ($setting = Setting::where('slug', $slug)->first()) {
					$setting->update(['value' => $value]);
				}
			}
		}
		return true;
	}

	public static function _updateValue($slug, $value)
	{
		$setting = Setting::where('slug', $slug)->firstOrFail();
		return $setting->update(['value' => $value]) ? true : false;
	}

	public static function _updateStatus($slug)
	{
		$setting = Setting::where('slug', $slug)->first();
		$setting->update(['value' => $setting->value == 'OFF' ? 'ON' : 'OFF']);
	}

	public static function _get_data($slug)
	{
		$settings = self::_init();
		return $settings[$slug] ?? null;
	}

	public static function _init()
	{
		$slugs = [
			'website-title',
			'website-domain',
			'admin-email',
			'mailchimp-status',
			'contact-title',
			'contact-email',
			'contact-address',
			'contact-phone',
			'contact-mobile',
		];

		return cache()->remember('settings_cache', config('app.config.cache.24HR'), function () use ($slugs) {
			$settings = Setting::select('slug', 'value')->whereIn('slug', $slugs)->get()->toArray();
			return array_column($settings, 'value', 'slug');
		});
	}
}
