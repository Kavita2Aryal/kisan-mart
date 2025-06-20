<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    
    protected $table = 'pages';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function alias()
    {
        return $this->hasOne('App\Models\Cms\WebAlias', 'page_id');
    }

    public function section_contents()
    {
        return $this->hasMany('App\Models\Cms\Page\SectionContent', 'page_id')->orderBy('display_order', 'ASC');
    }

    public function seo()
    {
        return $this->hasOne('App\Models\Cms\Page\PageSeo', 'page_id');
    }

    public function popups()
    {
        return $this->belongsToMany('App\Models\Cms\Popup\Popup', 'popup_pages', 'page_id', 'popup_id');
    }

    public function hyperlink_search_format()
    {
        $domain = get_setting('website-domain');
        return [
            'id'   => $this->id,
            'url'  => $domain.$this->alias->alias,
            'text' => $this->name,
            'created_at' => date('Y-m-d', strtotime($this->created_at))
        ];
    }
}