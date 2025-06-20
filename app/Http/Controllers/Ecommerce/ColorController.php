<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Ecommerce\ColorRequest;
use App\Services\Ecommerce\ColorService;
use App\Services\Ecommerce\ColorGroupService;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $colors = ColorService::_paging($request);
        return view('modules.ecommerce.color.index', compact('colors'));
    }

    public function create()
    {
        $color_groups = ColorGroupService::_get();
        return view('modules.ecommerce.color.create', compact('color_groups'));
    }

    public function store(ColorRequest $request)
    {
        if (ColorService::_storing($request)) {
            return redirect()->route('color.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create color at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $color = ColorService::_find($uuid);
        $color_groups = ColorGroupService::_get();
        return view('modules.ecommerce.color.edit', compact('color', 'color_groups'));
    }

    public function update(ColorRequest $request, $uuid)
    {
        if (ColorService::_updating($request, $uuid)) {
            return redirect()->route('color.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update color at this time. Please try again later.');
    }

    public function change_status($uuid)
    {
        $response = ColorService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function search(Request $request)
    {
        $data = [];
        if ($request->ajax()) {
            if (isset($request->q)) {
                $data = ColorService::_search($request->q);
            }
            return response()->json($data);
        }
        abort(404);
    }
}
