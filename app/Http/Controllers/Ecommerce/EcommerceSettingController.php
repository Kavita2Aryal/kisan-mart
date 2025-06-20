<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\General\Setting;
use App\Services\General\SettingService;
use App\Http\Requests\General\SettingUpdate;

class EcommerceSettingController extends Controller
{
    public function index()
    {
        $slugs = [
            'offer-title',
            'offer-link-title',
            'offer-link',
            'offer-status',
            'vat-rate',
            'vat-applicable',
            'help-title',
            'help-description',
            'help-status',
            'delivery-title',
            'delivery-description',
            'delivery-status',
            'delivery-partner-title',
            'delivery-partner-description',
            'delivery-partner-status',
            'made-with-love-title',
            'made-with-love-description',
            'made-with-love-status',
            'happy-customer-title',
            'happy-customer-description',
            'happy-customer-status',
            'payment-options',
        ];

        $data = Setting::select('slug', 'value')->whereIn('slug', $slugs)->get()->toArray();
        $data = array_column($data, 'value', 'slug');
        $meta_image = '';

        return view('modules.ecommerce.setting.index', compact('data', 'meta_image'));
    }
}