<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\ColorGroupRequest;
use App\Services\Ecommerce\ColorGroupService;

class ColorGroupController extends Controller
{
    public function index(Request $request)
    {
        $color_groups = ColorGroupService::_paging($request);
        return view('modules.ecommerce.color-group.index', compact('color_groups'));
    }

    public function create()
    {
        return view('modules.ecommerce.color-group.create');
    }

    public function store(ColorGroupRequest $request)
    {
        if (ColorGroupService::_storing($request)) {
            return redirect()->route('color.group.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create color group at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $color_group = ColorGroupService::_find($uuid);
        return view('modules.ecommerce.color-group.edit', compact('color_group'));
    }

    public function update(ColorGroupRequest $request, $uuid)
    {
        if (ColorGroupService::_updating($request, $uuid)) {
            return redirect()->route('color.group.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update color group at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = ColorGroupService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function search(Request $request)
    {
        $data = [];
        if ($request->ajax()) {
            if (isset($request->q)) {
                $data = ColorGroupService::_search($request->q);
            }
            return response()->json($data);
        }
        abort(404);
    }
}
