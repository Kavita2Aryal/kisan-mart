<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolePermission extends Model
{
	use HasFactory;
    
    protected $table = 'role_permissions';
    public $timestamps = false;
    protected $fillable = [
        'role_id', 'permission_id'
    ];
}