<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListConfigHead extends Model
{
    use HasFactory;
    
    protected $table = 'list_config_heads';
    public $timestamps = false;

    public function list_config_body()
    {
        return $this->hasMany('App\Models\Cms\Page\ListConfigBody', 'head_id');
    }

    public function list_content_head()
    {
        return $this->hasOne('App\Models\Cms\Page\ListContentHead', 'list_config_id');
    }
}
