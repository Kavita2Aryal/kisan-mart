<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebAlias extends Model
{
    use HasFactory;
    
    protected $table = 'web_alias';
    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo('App\Models\Cms\Page\Page', 'page_id');
    }

    public function blog()
    {
        return $this->belongsTo('App\Models\Addons\Blog\Blog', 'blog_id');
    }

    public function news()
    {
        return $this->belongsTo('App\Models\Addons\News\News', 'news_id');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Addons\Event\Event', 'event_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Travel\Package\Package', 'package_id');
    }
}