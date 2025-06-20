<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\PageConfig;

class PageConfigService
{
    public static function _get()
    {
        return cache()->remember('page_layout_config_cache', config('app.config.cache.24HR'), function () {
            return PageConfig::select('name', 'uuid', 'sections')->orderBy('name', 'ASC')->get()->toArray();
        });
    }

	public static function _storing($req)
    {
        $config            = new PageConfig();
        $config->name      = $req->name;
        $config->sections  = json_encode(array_values($req->sections));
        $config->header_id = null;
        $config->footer_id = null;
        $config->is_preset = null;
        return $config->save() ? true : false;
    }

    public static function _deleting($uuid)
    {
        PageConfig::where('uuid', $uuid)->first()->delete();
    }
}
