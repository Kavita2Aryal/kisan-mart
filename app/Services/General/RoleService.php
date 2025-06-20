<?php

namespace App\Services\General;

use App\Models\General\Role;
use App\Services\General\PermissionService;

class RoleService
{
    public static function _find($uuid)
    {
        return Role::where('uuid', $uuid)->firstOrFail();
    }

    public static function _find_by_id($id)
    {
        return Role::findOrFail($id);
    }

    public static function _get($no_super = true)
    {
        return ($no_super) 
            ? Role::with(['role_permissions', 'user'])->select('id', 'role')->where('is_active', 10)->whereNull('is_super')->orderBy('role', 'ASC')->get()
            : Role::with(['role_permissions', 'user'])->orderBy('role', 'ASC')->get();
    }

    public static function _storing($req)
    {
        $role = new Role();
        $role->role = strtolower($req->role);
        $role->is_active = $req->has('is_active') ? 10 : 0;
        
        if ($role->save()) { 
            PermissionService::save_role_permission($req->permissions, $role->id);
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $role = self::_find($uuid);
        if (!$role) return false;

        $role->role = strtolower($req->role);
        $role->is_active = $req->has('is_active') ? 10 : 0;
        
        if ($role->update()) {
            PermissionService::delete_role_permission($role->id);
            PermissionService::save_role_permission($req->permissions, $role->id);
            return true;
        }
        return false;
    }

    public static function _change_status($uuid)
    {
        $role = self::_find($uuid);
        if (!$role) return -1;

        $role->is_active = ($role->is_active == 10 ? 0 : 10);
        $role->update();
        return $role->is_active;
    }
}