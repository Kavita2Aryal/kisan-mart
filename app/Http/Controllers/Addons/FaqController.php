<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\FaqService;
use App\Http\Requests\Addons\FaqRequest;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = FaqService::_paging($request);
        return view('modules.addons.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('modules.addons.faq.create');
    }

    public function store(FaqRequest $request)
    {
        if (FaqService::_storing($request)) {
            return redirect()->route('faq.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create faq at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $faq = FaqService::_find($uuid);
        return view('modules.addons.faq.edit', compact('faq'));
    }

    public function update(FaqRequest $request, $uuid)
    {
        if (FaqService::_updating($request, $uuid)) {
            return redirect()->route('faq.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update faq at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (FaqService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the faq at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = FaqService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function sort() 
    {
        $faqs = FaqService::_get();
        return view('modules.addons.faq.sort', compact('faqs'));
    }

    public function manage_order(Request $request)
    {
        if (!$request->ajax()) abort(403);
        FaqService::_ordering($request->faq);
        return response()->json(true);
    }
}