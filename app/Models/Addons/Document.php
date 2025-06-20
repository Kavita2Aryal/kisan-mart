<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    
    protected $table = 'documents';
    public $timestamps = false;

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
