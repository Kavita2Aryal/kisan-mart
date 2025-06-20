<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageX extends Model
{
    use HasFactory;
    
    protected $table = 'images';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}