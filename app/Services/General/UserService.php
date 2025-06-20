<?php

namespace App\Services\General;

use App\Models\General\User;
use App\Services\General\PermissionService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function _find($uuid)
    {
        return User::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return User::orderBy('name', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = User::with(['role'])->orderBy('name', 'ASC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('role', function ($query1) use ($search) {
                        $query1->where('role', 'LIKE', '%'.$search.'%');
                    });
            });
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $user = new User();
        $user->name      = $req->name;
        $user->email     = $req->email;
        $user->password  = Hash::make($req->password);
        $user->role_id   = $req->role_id;
        $user->is_active = $req->has('is_active') ? 10 : 0;
        
        if ($user->save()) {
            PermissionService::save_user_permission($req->permissions, $user->id);
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $user = User::with('role')->where('uuid', $uuid)->firstOrFail();
        if (!$user) return false; 

        $user->name    = $req->name;
        $user->email   = $req->email;
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        
        if ($user->role->is_super == null) {
            $user->role_id = $req->role_id;
        }   

        if ($user->role->is_super == null && auth()->user()->id != $user->id) {
            $user->is_active = $req->has('is_active') ? 10 : 0;
        }
        
        if ($req->filled('password')) {
            $user->password = Hash::make($req->password);
        }

        if ($user->update()) {
            if ($user->role->is_super == null && $req->has('permissions')) { 
                PermissionService::delete_user_permission($user->id);
                PermissionService::save_user_permission($req->permissions, $user->id);
            }
            return true;
        }
        return false;
    }

    public static function _change_status($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        if (!$user) return -1;

        $user->is_active = ($user->is_active == 10 ? 0 : 10);
        $user->update();
        return $user->is_active;
    }
}