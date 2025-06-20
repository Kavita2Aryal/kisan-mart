<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Cms\Slider;
use App\Models\Cms\Page\Page;
use App\Services\Cms\Page\PageService;
use App\Services\Cms\Page\PageConfigService;
use App\Services\Cms\Page\SectionContentService;

use App\Http\Requests\Cms\Page\PageStore;
use App\Http\Requests\Cms\Page\PageUpdate;
use App\Http\Requests\Cms\Page\PageUpdateSection;

class PageController extends Controller
{
    public function index(Request $request)
    {
    	$pages = PageService::_paging($request);
        return view('modules.cms.page.index', compact('pages'));
    }

    /* page layout */
    public function create_layout(Request $request)
    {
        if ($request->session()->has('temp_page_layout')) {
            $temp_layout = $request->session()->get('temp_page_layout');
        }
        else {
            $temp_layout = [
                'header' => 1,
                'footer' => 1,
                'sections' => []
            ];
        }
        
        $sections = get_section_config();
        $filters  = get_list_group('section_filters');
        $headers  = get_list_group('website_headers');
        $footers  = get_list_group('website_footers');
        $layouts  = PageConfigService::_get();
        return view('modules.cms.page.create_layout', compact('temp_layout', 'filters', 'sections', 'headers', 'footers', 'layouts'));
    }

    public function store_layout(Request $request) 
    { 
        $request->session()->put('temp_page_layout', $request->except('_token'));
        return redirect()->route('page.create');
    }

    public function edit_layout($uuid)
    {
        if ($page = Page::where('uuid', $uuid)->first()) { 
            $sections = get_section_config();
            $filters  = get_list_group('section_filters');
            $headers  = get_list_group('website_headers');
            $footers  = get_list_group('website_footers');
            $layouts  = PageConfigService::_get();
            return view('modules.cms.page.edit_layout', compact('page', 'filters', 'sections', 'headers', 'footers', 'layouts'));
        }
        return back()
            ->with('error', 'The page you want to edit does not exist.');
    }

    public function update_layout(Request $request, $uuid)
    {
        if (PageService::_layout_updating($request, $uuid)) {
            return redirect()->route('page.edit', [$uuid])->with('success', 'The page layout has been updated.');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update page at this time. Please try again later.');
    }
    /* page layout */

    /* mini cms & add page */
    public function create_mini(Request $request)
    {
        $temp_layout = config('app.config.mini_cms_sections');
        $sections = get_section_config(); 
        $headers  = get_list_group('website_headers');
        $footers  = get_list_group('website_footers');
        return view('modules.cms.page.create_mini', compact('temp_layout', 'sections', 'headers', 'footers'));
    }

    public function store_mini(PageStore $request) 
    { 
        if ($uuid = PageService::_storing($request)) { 
            return redirect()->route('page.edit', [$uuid]);
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create page at this time. Please try again later.');
    }
    /* mini cms & add page */

    /* full cms & add page */
    public function create(Request $request)
    {
        if ($request->session()->has('temp_page_layout')) {
            $temp_layout = $request->session()->get('temp_page_layout');
            $sections = get_section_config(); 
            $headers  = get_list_group('website_headers');
            $footers  = get_list_group('website_footers');
            
            return view('modules.cms.page.create', compact('temp_layout', 'sections', 'headers', 'footers'));
        }
        return redirect()->route('page.layout.create')
            ->with('error', 'Please design the layout of the page before proceeding.');
    }

    public function store(PageStore $request) 
    { 
        if ($uuid = PageService::_storing($request)) { 
            $request->session()->forget('temp_page_layout');
            return redirect()->route('page.edit', [$uuid]);
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create page at this time. Please try again later.');
    }

    public function store_layout_config(Request $request)
    {
        if (PageConfigService::_storing($request)) { 
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not save page layout at this time. Please try again later.');
    }

    public function destroy_layout_config($uuid)
    {
        if (PageConfigService::_deleting($uuid)) { 
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete page layout at this time. Please try again later.');
    }
    /* full cms & add page */

    public function edit(Request $request, $uuid)
    {
        $page = Page::with([
            'section_contents.descriptions',
            'section_contents.image_contents.image',
            'section_contents.slider_contents',
            'section_contents.list_links',
            'section_contents.list_videos.thumbnail',
            'section_contents.section_config.list_config_body.list_content_body.image_contents.image',
            'section_contents.section_config.list_config_body.list_config_head.list_content_head.image_contents.image',
        ])
        ->where('uuid', $uuid)->firstOrFail();
            
        $active_section = $request->filled('section') ? filter_var($request->query('section'), FILTER_VALIDATE_INT) : 0;
        $active_section = $active_section > 0 ? $active_section : 0;

        $sections = get_section_config(); 
        $headers  = get_list_group('website_headers');
        $footers  = get_list_group('website_footers');
        $icons    = get_list_group('icons');
        $social_icons = get_list_group('social_icons');

        $sliders = Slider::select('id', 'name')->get();

        return view('modules.cms.page.edit', compact('page', 'active_section', 'sections', 'headers', 'footers', 'icons', 'social_icons', 'sliders'));
    }

    public function update(PageUpdate $request, $uuid)
    {
        if (PageService::_updating($request, $uuid)) {
            return back();
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update page at this time. Please try again later.');
    }

    public function update_section(PageUpdateSection $request, $uuid)
    {  
        if (SectionContentService::_updating($request, $uuid)) {
            return back();
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update page at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (PageService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the page at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = PageService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function change_home($uuid) 
    {
        if (PageService::_change_home($uuid)) {
            return back()
                ->with('success', 'The page has been marked as home page.');
        }
        return back()
            ->with('error', 'Sorry, could not make the page as home page at this time. Please try again later.');
    }

    public function check(PageUpdateSection $request)
    {
        return response()->json(true, 200);
    }

    public function generate_form(Request $request)
    {
        $html = '';
        if ($request->type == 'description') {
            $html = view('modules.cms.page.includes.form_description', compact('request'))->render();
        }
        else if ($request->type == 'link') {
            $html = view('modules.cms.page.includes.form_link', compact('request'))->render();
        }
        else if ($request->type == 'list_body') {
            $html = view('modules.cms.page.includes.form_list_body', compact('request'))->render();
        }
        return response()->json(['html' => $html], 200);
    }
}