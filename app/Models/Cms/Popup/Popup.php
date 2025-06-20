<?php

namespace App\Models\Cms\Popup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Popup extends Model
{
    use HasFactory;
    
    protected $table = 'popups';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }

    public function pages()
    {
        return $this->belongsToMany('App\Models\Cms\Page\Page', 'popup_pages', 'popup_id', 'page_id');
    }
}