<?php

namespace App\Models\Addons\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blogs';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function alias()
    {
        return $this->hasOne('App\Models\Cms\WebAlias', 'blog_id');
    }

    public function intro_image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'intro_image_id');
    }

    public function banner_image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'banner_image_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Addons\Author', 'author_id');
    }

    public function contents()
    {
        return $this->hasMany('App\Models\Addons\Blog\BlogContent', 'blog_id')->orderBy('display_order', 'ASC');
    }

    public function seo()
    {
        return $this->hasOne('App\Models\Addons\Blog\BlogSeo', 'blog_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Addons\Blog\BlogCategory', 'category_id');
    }
}