<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;

use App\Services\General\PermissionService;

class Role extends Model
{
    use HasFactory;
    
    protected $table = 'roles';
    
    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function role_permissions()
    {
        return $this->hasMany('App\Models\General\RolePermission', 'role_id');
    }

    public function permissions()
    {
        if ($this->is_super == 10) {
            return '*';
        }
        else {
            $permissions = PermissionService::config_permissions();
            $role_permissions = Arr::pluck($this->role_permissions->toArray(), 'permission_id');
            return Arr::only($permissions, $role_permissions);
        }
    }
}
