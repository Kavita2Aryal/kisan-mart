<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Cms\SliderService;
use App\Http\Requests\Cms\SliderRequest;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = SliderService::_paging($request);
        return view('modules.cms.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('modules.cms.slider.create');
    }

    public function store(SliderRequest $request)
    {
        if (SliderService::_storing($request)) {
            return redirect()->route('slider.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create slider at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $slider = SliderService::_find($uuid);
        return view('modules.cms.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, $uuid)
    {
        if (SliderService::_updating($request, $uuid)) {
            return redirect()->route('slider.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update slider at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (SliderService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the slider at this time. Please try again later.');
    }

    public function sort($uuid) 
    {
        $items = SliderService::_item_sort($uuid);
        return view('modules.cms.slider.sort', compact('items'));
    }

    public function manage_order(Request $request)
    {
        if (!$request->ajax()) abort(403);
        SliderService::_item_ordering($request->input('items'));
        return response()->json(true);
    }

    public function generate_form(Request $request)
    {
        $view = ($request->type == 'video') ? 'video' : 'image';
        return response()->json([
            'html' => view('modules.cms.slider.includes.'.$view)->render()
        ], 200);
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'sliders' => SliderService::_get()
            ]);
        }
        abort(403);
    }
}