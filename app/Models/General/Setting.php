<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    
    protected $table = 'settings';
    protected $fillable = [
        'name', 'slug', 'value', 'is_active'
    ];

	public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}