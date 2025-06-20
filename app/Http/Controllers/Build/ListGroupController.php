<?php

namespace App\Http\Controllers\Build;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Build\ListGroupService;
use App\Http\Requests\Build\ListGroupStore;
use App\Http\Requests\Build\ListGroupUpdate;

class ListGroupController extends Controller
{
    public function index(Request $request)
    {
        $list_groups = ListGroupService::_get();
        $list_types = config('app.config.list_group_types');
        return view('modules.build.list-group.index', compact('list_groups', 'list_types'));
    }

    public function create()
    {
        $list_types = config('app.config.list_group_types');
        return view('modules.build.list-group.create', compact('list_types'));
    }

    public function store(ListGroupStore $request)
    {
        if (ListGroupService::_storing($request)) {
            return redirect()->route('list.group.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create list group at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $list_group = ListGroupService::_find($uuid);
        $list_types = config('app.config.list_group_types');
        $list_items = !empty($list_group->items) ? json_decode($list_group->items) : null;
        return view('modules.build.list-group.edit', compact('list_group', 'list_types', 'list_items'));
    }

    public function update(ListGroupUpdate $request, $uuid)
    {
        if (ListGroupService::_updating($request, $uuid)) {
            return redirect()->route('list.group.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update list group at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (ListGroupService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the list group at this time. Please try again later.');
    }

    public function generate_form(Request $request)
    {
        $view = ($request->type == 'title_value') ? 'title-value' : 'only-value';
        return response()->json([
            'html' => view('modules.build.list-group.includes.'.$view)->render()
        ], 200);
    }
}
