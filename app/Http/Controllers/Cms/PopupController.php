<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Cms\PopupRequest;
use App\Services\Cms\Popup\PopupService;

class PopupController extends Controller
{
    public function index(Request $request)
    {   
        $popups = PopupService::_paging($request);
        return view('modules.cms.popup.index', compact('popups'));
    }

    public function create()
    {
        return view('modules.cms.popup.create');
    }

    public function store(PopupRequest $request)
    {
        if (PopupService::_storing($request)) {
            return redirect()->route('popup.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update Popup at this time. Please try again later.');
    }

    public function edit($uuid)
    { 
    	$popup = PopupService::_find($uuid);
        return view('modules.cms.popup.edit', compact('popup'));
    }

    public function update(PopupRequest $request, $uuid)
    {
        if (PopupService::_updating($request, $uuid)) {
            return redirect()->route('popup.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update Popup at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (PopupService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the Popup at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = PopupService::_change_status($uuid);
        return response()->json($response, 200);
    }
}