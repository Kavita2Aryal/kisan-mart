<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPermission extends Model
{
	use HasFactory;
    
    protected $table = 'user_permissions';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'permission_id'
    ];
}
