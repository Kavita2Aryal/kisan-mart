<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $table = 'email_templates';
    
    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
