<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Cms\WebAliasService;
use App\Http\Requests\Cms\WebAliasCheck;

class WebAliasController extends Controller
{
    public function index(Request $request)
    {
        $alias = WebAliasService::_paging($request);
        $default_pages = get_list_group('default_pages'); 
        return view('modules.cms.web_alias.index', compact('alias', 'default_pages'));
    }
 
    public function update(WebAliasCheck $request)
    {
        $response = WebAliasService::_checking($request);
        if ($response['status'] == 'success') {
            WebAliasService::_updating('id', $request->id, $request->alias);
        }
        return response()->json($response, 200);
    }

    public function check(WebAliasCheck $request)
    {
        $response = WebAliasService::_checking($request);
        return response()->json($response, 200);
    }

    public function change_status(Request $request) 
    {
        $response = WebAliasService::_change_status($request);
        return response()->json($response, 200);
    }

    public function generate_form(Request $request)
    {
        $view = ($request->type == 'desktop') ? 'edit' : 'edit_mobile';
        return response()->json([
            'html' => view('modules.cms.web_alias.includes.'.$view, compact('request'))->render()
        ], 200);
    }

    public function hyperlink_search(Request $request, $uuid)
    {
        return response()->json([
            'status'  => 200,
            'payload' => WebAliasService::hyperlink_search($request, $uuid)
        ], 200);
    }
}