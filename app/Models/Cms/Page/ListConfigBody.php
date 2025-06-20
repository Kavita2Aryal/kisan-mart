<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListConfigBody extends Model
{
    use HasFactory;
    
    protected $table = 'list_config_bodies';
    public $timestamps = false;

    public function list_config_head()
    {
        return $this->belongsTo('App\Models\Cms\Page\ListConfigHead', 'head_id');
    }

    public function list_content_body()
    {
        return $this->hasMany('App\Models\Cms\Page\ListContentBody', 'list_config_id');
    }
}
