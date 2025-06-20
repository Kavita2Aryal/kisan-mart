<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Cms\PageService;

class PageController extends Controller
{
    public function index()
    {
        $page = PageService::_find_home();
        abort_if((!$page || $page->section_contents->count() <= 0), 404);

        return PageService::_get_section_contents($page, $page->section_contents);
    }

    public function show()
    {
        $web = check_web_page_type(true);

        abort_if(!$web['status'], 404);

        $page = PageService::_find($web['web']->page_id);

        abort_if((!$page || $page->section_contents->count() <= 0), 404);

        return PageService::_get_section_contents($page, $page->section_contents);
    }

    public function preview(Request $request)
    {
        abort_if((!$request->has('id') || $request->has('id') == ''), 404);

        $params = decrypt($request->get('id'));
        $params = explode("___", $params);

        abort_if((count($params) != 2), 404);

        $uuid = $params[0];
        $check_timestamp   = strtotime('+15 minutes', $params[1]);
        $current_timestamp = time();

        abort_if(($check_timestamp < $current_timestamp), 404);

        $page = PageService::_find_preview($uuid); dd($page);

        abort_if((!$page || $page->section_contents->count() <= 0), 404);

        return PageService::_get_section_contents($page, $page->section_contents);
    }
}
