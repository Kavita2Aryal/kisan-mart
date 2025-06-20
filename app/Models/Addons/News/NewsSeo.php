<?php

namespace App\Models\Addons\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsSeo extends Model
{
    use HasFactory;
    
    protected $table = 'news_seos';
    public $timestamps = false;

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}
