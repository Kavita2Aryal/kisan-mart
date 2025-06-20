<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\TestimonialService;
use App\Http\Requests\Addons\TestimonialRequest;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $testimonials = TestimonialService::_paging($request);
        return view('modules.addons.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('modules.addons.testimonial.create');
    }

    public function store(TestimonialRequest $request)
    {
        if (TestimonialService::_storing($request)) {
            return redirect()->route('testimonial.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create testimonial at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $testimonial = TestimonialService::_find($uuid);
        return view('modules.addons.testimonial.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, $uuid)
    {
        if (TestimonialService::_updating($request, $uuid)) {
            return redirect()->route('testimonial.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update testimonial at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (TestimonialService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the testimonial at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = TestimonialService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function sort() 
    {
        $testimonials = TestimonialService::_get($sort = false);
        return view('modules.addons.testimonial.sort', compact('testimonials'));
    }

    public function manage_order(Request $request)
    {
        if (!$request->ajax()) abort(403);
        TestimonialService::_ordering($request->testimonial);
        return response()->json(true);
    }
}