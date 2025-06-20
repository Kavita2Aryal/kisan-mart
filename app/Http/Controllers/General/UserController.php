<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\General\UserService;
use App\Services\General\RoleService;
use App\Http\Requests\General\UserStore;
use App\Http\Requests\General\UserUpdate;
use App\Http\Requests\General\ProfileUpdate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserService::_paging($request);
        return view('modules.general.user.index', compact('users'));
    }

    public function create()
    {
        $roles = RoleService::_get($no_super = true);
        return view('modules.general.user.create', compact('roles'));
    }

    public function store(UserStore $request)
    {
        if (!$request->has('permissions')) {
            return back()->withInput()->with('permission-error', 'error');
        }

        if (UserService::_storing($request)) {
            return redirect()->route('user.index')
                ->with('success', 'User has been created.');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create user at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $user = UserService::_find( $uuid);
        $roles = RoleService::_get($no_super = true);
        return view('modules.general.user.edit', compact('user', 'roles'));
    }

    public function update(UserUpdate $request, $uuid)
    {
        if (!$request->has('permissions')) {
            return back()->withInput()->with('permission-error', 'error');
        }
        
        if (UserService::_updating($request, $uuid)) {
            return redirect()->route('user.index')
                ->with('success', 'User has been updated.');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update user at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = UserService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function view_permission($uuid)
    {
        $user = UserService::_find($uuid);
        return response()->json([
            'html' => view('modules.general.user.includes.view_permission', compact('user'))->render()
        ], 200);
    }
}