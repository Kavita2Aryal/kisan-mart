<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\PartnerService;
use App\Http\Requests\Addons\PartnerRequest;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $partners = PartnerService::_paging($request);
        return view('modules.addons.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('modules.addons.partner.create');
    }

    public function store(PartnerRequest $request)
    {
        if (PartnerService::_storing($request)) {
            return redirect()->route('partner.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create partner at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $partner = PartnerService::_find($uuid);
        return view('modules.addons.partner.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, $uuid)
    {
        if (PartnerService::_updating($request, $uuid)) {
            return redirect()->route('partner.index');
        }
        return back()
            ->withInput()
            ->with('error', 'Sorry, could not update partner at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (PartnerService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the partner at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = PartnerService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function sort() 
    {
        $partners = PartnerService::_get();
        return view('modules.addons.partner.sort', compact('partners'));
    }

    public function manage_order(Request $request)
    {
        if (!$request->ajax()) abort(403);
        PartnerService::_ordering($request->partner);
        return response()->json(true);
    }
}