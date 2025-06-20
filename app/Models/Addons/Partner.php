<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;
    
    protected $table = 'partners';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}
