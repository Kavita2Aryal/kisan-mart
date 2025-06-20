<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSeo extends Model
{
    use HasFactory;
    
    protected $table = 'page_seos';
    public $timestamps = false;

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}