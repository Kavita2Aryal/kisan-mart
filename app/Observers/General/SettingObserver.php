<?php

namespace App\Observers\General;

use App\Models\General\Setting;
use App\Services\General\LogService;

class SettingObserver
{
    public function creating(Setting $setting)
    {
        $setting->user_id = auth()->user()->id;
    }

    public function updated(Setting $setting)
    {
        LogService::queue('setting', $setting->name . ' - updated');
        session()->flash('success', 'Setting has been updated.');
        cache()->flush();
    }
}
