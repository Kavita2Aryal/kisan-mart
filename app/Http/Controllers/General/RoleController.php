<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\General\RoleService;
use App\Http\Requests\General\RoleStore;
use App\Http\Requests\General\RoleUpdate;

class RoleController extends Controller
{
    public function index()
    {
    	$roles = RoleService::_get($no_super = false);
        return view('modules.general.role.index', compact('roles'));
    }

    public function create()
    {
        return view('modules.general.role.create');
    }

    public function store(RoleStore $request)
    {
        if (!$request->has('permissions')) {
            return back()->withInput()->with('permission-error', 'error');
        }
        
        if (RoleService::_storing($request)) {
            return redirect()->route('role.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create role at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $role = RoleService::_find($uuid);
        return view('modules.general.role.edit', compact('role'));
    }

    public function update(RoleUpdate $request, $uuid)
    {
        if (!$request->has('permissions')) {
            return back()->withInput()->with('permission-error', 'error');
        }

        if (RoleService::_updating($request, $uuid)) {
            return redirect()->route('role.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update role at this time. Please try again later.');
    }

    public function permissions(Request $request)
    {
        if ($role = RoleService::_find_by_id($request->id)) {
            return response()->json($role->permissions(), 200);
        }
        return response()->json(false, 200);
    }
}