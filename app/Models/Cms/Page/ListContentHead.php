<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListContentHead extends Model
{
    use HasFactory;
    
    protected $table = 'list_content_heads';
	public $timestamps = false;

    public function list_config_head()
    {
        return $this->belongsTo('App\Models\Cms\Page\ListConfigHead', 'list_config_id');
    }

    public function list_content_body()
    {
        return $this->hasOne('App\Models\Cms\Page\ListContentBody', 'head_id');
    }

    public function section_content()
    {
        return $this->belongsTo('App\Models\Cms\Page\SectionContent', 'section_id');
    }

    public function image_contents()
    {
        return $this->hasMany('App\Models\Cms\Page\ImageListContentHead', 'list_id');
    }
}
