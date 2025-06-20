<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cms\Page\Page;
use App\Models\General\Setting;

class MenuController extends Controller
{
    public function desktop()
    {
        $url = get_setting('website-domain');
        $default_pages = get_list_group('default_pages'); 
        $pages = Page::select('id', 'name')->with('alias')->where(['is_active' => 10])->latest()->get();
        $menu_designs  = Setting::select('value')->where('slug', 'desktop-menu-designs')->first();
        
        return view('modules.cms.menu.desktop', compact('menu_designs', 'url', 'default_pages', 'pages'));
    }

    public function mobile()
    {
        $url = get_setting('website-domain');
        $default_pages = get_list_group('default_pages');
        $pages = Page::select('id', 'name')->with('alias')->where(['is_active' => 10])->latest()->get();
        $settings = Setting::select('slug', 'value')->whereIn('slug', ['mobile-menu-designs', 'mobile-menu-as-desktop-menu'])->get();
        $menu_designs = $settings->where('slug', 'mobile-menu-designs')->first();
        $same_as_desktop = $settings->where('slug', 'mobile-menu-as-desktop-menu')->first();
        
        return view('modules.cms.menu.mobile', compact('menu_designs', 'same_as_desktop', 'url', 'default_pages', 'pages'));
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) abort(403);

        if ($request->menu_type == 'mobile') {

            $bool = Setting::where('slug', 'mobile-menu-as-desktop-menu')->first();
            $bool->forceFill(['value' => $request->same_as_desktop ? 'YES' : 'NO' ])->update();

            if ($request->same_as_desktop == 'YES') {
                $setting = Setting::select('value')->where('slug', 'desktop-menu-designs')->first();
                $this->_save_menu('mobile-menu-designs', $setting->value);
            } 
            else {
                $this->_save_menu('mobile-menu-designs', $request->design);
            }
        } 
        else if ($request->menu_type == 'desktop') {
            $this->_save_menu('desktop-menu-designs', $request->design);

            $bool = Setting::select('value')->where('slug', 'mobile-menu-as-desktop-menu')->first();
            if ($bool->value == 10) {
                $this->_save_menu('mobile-menu-designs', $request->design);
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function _save_menu($slug, $design)
    {
        $setting = Setting::where('slug', $slug)->first();
        $setting->value = $design;
        $setting->update();
    }
}