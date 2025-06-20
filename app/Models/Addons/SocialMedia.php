<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialMedia extends Model
{ 
    use HasFactory;
    
    protected $table = 'social_medias';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
