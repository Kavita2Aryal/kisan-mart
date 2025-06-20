<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\General\Setting;
use App\Services\General\SettingService;
use App\Http\Requests\General\SettingUpdate;

class SettingController extends Controller
{
    public function index()
    {
        $slugs = [
            'maintenance-mode', 
            'website-title', 
            'website-domain', 
            'admin-email', 
            'noreply-email', 
            'generic-meta-image', 
            'generic-meta-image-alt', 
            'generic-meta-title', 
            'generic-meta-keywords', 
            'generic-meta-description',
            'contact-title',
            'contact-phone',
            'contact-mobile',
            'contact-email',
            'contact-address',
            'logo-image',
            'favicon-image',
            'mailchimp-status',
            'hotjar-status',
            'google-analytics-status',
            'chatbot-status',
            'third-party-status',
            'hotjar-embed',
            'google-analytics-embed',
            'chatbot-embed',
            'third-party-embed',
        ];

        $data = Setting::select('slug', 'value')->whereIn('slug', $slugs)->get()->toArray();
        $data = array_column($data, 'value', 'slug');
        
        $image = SettingService::_images([ 
            'generic-meta-image' => $data['generic-meta-image'],
            'logo-image' => $data['logo-image'],
            'favicon-image' => $data['favicon-image'] 
        ]);

        return view('modules.general.setting.index', compact('data', 'image'));
    }

    public function update(SettingUpdate $request)
    {
        SettingService::_update($request);
        return back()
            ->with('success', 'Web Settings has been updated.');
    }

    public function update_value($slug, Request $request)
    {
        SettingService::_updateValue($slug, $request->value);
        return back()
            ->with('success', 'Web Settings has been updated.');
    }

    public function update_status($slug)
    {
        SettingService::_updateStatus($slug);
        return back()
            ->with('success', 'Web Settings has been updated.');
    }
}