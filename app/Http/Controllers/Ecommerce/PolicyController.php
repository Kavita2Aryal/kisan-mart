<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\PolicyRequest;
use Illuminate\Http\Request;

use App\Services\Ecommerce\PolicyService;

class PolicyController extends Controller
{
    public function index(Request $request)
    {
        $policies = PolicyService::_paging($request);
        return view('modules.ecommerce.policy.index', compact('policies'));
    }

    public function create()
    {
        $policies = PolicyService::_get();
        return view('modules.ecommerce.policy.create', compact('policies'));
    }

    public function store(PolicyRequest $request)
    {
        if (PolicyService::_storing($request)) {
            return redirect()->route('policy.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not create policy at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $policy = PolicyService::_find($uuid);
        return view('modules.ecommerce.policy.edit', compact('policy'));
    }

    public function update(PolicyRequest $request, $uuid)
    {
        if (PolicyService::_updating($request, $uuid)) {
            return redirect()->route('policy.index');
        }
        return back()->withInput()->with('error', 'Sorry, could not update policy at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = PolicyService::_change_status($uuid);
        return response()->json($response, 200);
    }
}