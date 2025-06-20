<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\QuickLinkService;
use App\Http\Requests\Addons\QuickLinkRequest;

class QuickLinkController extends Controller
{
    public function index(Request $request)
    {
        $links = QuickLinkService::_paging($request);
        $groups = get_list_group('quick_link_groups');
        return view('modules.addons.quick_link.index', compact('links', 'groups'));
    }

    public function create()
    {
        $groups = get_list_group('quick_link_groups');
        return view('modules.addons.quick_link.create', compact('groups'));
    }

    public function store(QuickLinkRequest $request)
    {
        if (QuickLinkService::_storing($request)) {
            return redirect()->route('quick.link.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create quick link at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $link = QuickLinkService::_find($uuid);
        $groups = get_list_group('quick_link_groups');
        return view('modules.addons.quick_link.edit', compact('link', 'groups'));
    }

    public function update(QuickLinkRequest $request, $uuid)
    {
        if (QuickLinkService::_updating($request, $uuid)) {
            return redirect()->route('quick.link.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update quick link at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (QuickLinkService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the quick link at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = QuickLinkService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function sort($group_id) 
    {
        $links = QuickLinkService::_get($group_id);
        return view('modules.addons.quick_link.sort', compact('links'));
    }

    public function manage_order(Request $request)
    {
        if (!$request->ajax()) abort(403);
        QuickLinkService::_ordering($request->input('quick-link'));
        return response()->json(true);
    }
}