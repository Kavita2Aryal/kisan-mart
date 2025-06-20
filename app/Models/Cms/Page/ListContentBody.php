<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListContentBody extends Model
{
	use HasFactory;
    
    protected $table = 'list_content_bodies';
	public $timestamps = false;
    protected $fillable = [
        'description'
    ];

    public function list_config_body()
    {
        return $this->belongsTo('App\Models\Cms\Page\ListConfigBody', 'list_config_id');
    }

    public function list_content_head()
    {
        return $this->belongsTo('App\Models\Cms\Page\ListContentHead', 'head_id');
    }

    public function section_content()
    {
        return $this->belongsTo('App\Models\Cms\Page\SectionContent', 'section_id');
    }

    public function image_contents()
    {
        return $this->hasMany('App\Models\Cms\Page\ImageListContentBody', 'list_id');
    }
}
