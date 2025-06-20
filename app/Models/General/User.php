<?php

namespace App\Models\General;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Fortify\TwoFactorAuthenticatable;

use App\Services\General\PermissionService;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\General\Role', 'role_id');
    }

    public function user_permissions()
    {
        return $this->hasMany('App\Models\General\UserPermission', 'user_id');
    }

    public function self_permissions()
    {
        if (auth()->user()->role->is_super == 10) return '*';

        $permissions = PermissionService::config_permissions();
        $user_permissions = Arr::pluck(auth()->user()->user_permissions->toArray(), 'permission_id');
        return Arr::only($permissions, $user_permissions);
    }

    public function permissions()
    {
        if ($this->role->is_super == 10) return '*';

        $permissions = PermissionService::config_permissions();
        $user_permissions = Arr::pluck($this->user_permissions->toArray(), 'permission_id');
        return Arr::only($permissions, $user_permissions);
    }
}
