<?php

namespace App\Models\Addons\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogSeo extends Model
{
    use HasFactory;
    
    protected $table = 'blog_seos';
    public $timestamps = false;

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}
