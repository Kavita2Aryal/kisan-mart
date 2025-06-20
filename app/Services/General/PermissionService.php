<?php

namespace App\Services\General;

use Illuminate\Support\Arr;
use Gate;

use App\Models\General\User;
use App\Models\General\UserPermission;
use App\Models\General\RolePermission;

class PermissionService
{
    protected static $all_permits_keys = [];

    public static function save_user_permission($permissions, $user_id)
    {
        if (!empty($permissions)) {
            $batch = array_map(function ($permission) use ($user_id) {
                return [
                    'permission_id' => (int) $permission,
                    'user_id' => $user_id
                ];
            }, $permissions);

            UserPermission::insert($batch);
        }
    }

    public static function delete_user_permission($user_id)
    {
        UserPermission::where('user_id', $user_id)->delete();
    }

    public static function save_role_permission($permissions, $role_id)
    {
        if (!empty($permissions)) {
            $batch = array_map(function ($permission) use ($role_id) {
                return [
                    'permission_id' => (int) $permission,
                    'role_id' => $role_id
                ];
            }, $permissions);

            RolePermission::insert($batch);
        }
    }

    public static function delete_role_permission($role_id)
    {
        RolePermission::where('role_id', $role_id)->delete();
    }


    public static function alt_permission($permit)
    {
        $pre_permit = preg_split('/./', $permit);
        array_pop($pre_permit);
        return ['*', join('.', $pre_permit) . '.*', $permit];
    }

    public static function all_permissions_keys()
    {
        array_map(function ($permit) {
            self::$all_permits_keys = array_merge(self::$all_permits_keys, array_keys($permit));
        }, config('app.permissions'));

        return array_combine(self::$all_permits_keys, self::$all_permits_keys);
    }

    public static function config_permissions()
    {
        $config_permission_data = config('app.permissions');
        $config_permission_values = Arr::collapse($config_permission_data);

        $all_permits_keys = [];
        foreach ($config_permission_data as $permit) {
            $all_permits_keys = array_merge($all_permits_keys, array_keys($permit));
        }
        
        return (count($all_permits_keys) == count($config_permission_values))
            ? array_combine($all_permits_keys, $config_permission_values)
            : null;
    }

    public static function user_permissions($user)
    {
        $config_permissions = self::config_permissions();

        if ($user->role->is_super) {
            $user_permissions = $config_permissions;
        } else {
            $user_permission_data = $user->user_permissions->pluck('permission_id')->toArray();
            $user_permissions = Arr::only($config_permissions, $user_permission_data);
        }
        return $user_permissions;
    }

    public static function define_gates()
    {
        $config_permissions = cache()->remember('config.permissions', config('app.config.cache.24HR'), function () {
            return self::config_permissions();
        });

        abort_if($config_permissions == null, 500);

        array_walk($config_permissions, function ($permit, $permit_key) {
            Gate::define($permit, function (User $user) use ($permit) {
                $user_permissions = cache()->remember('user.' . $user->uuid . '.permissions', config('app.config.cache.24HR'), function () use ($user) {
                    return self::user_permissions($user);
                });
                return in_array($permit, $user_permissions);
            });
        });

        Gate::define('super.auth', function (User $user) {
            return session()->get('super-auth') ? true : false;
        });
    }
}
