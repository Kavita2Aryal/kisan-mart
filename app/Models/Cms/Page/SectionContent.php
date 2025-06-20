<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Services\Cms\Page\TypeContentService;

class SectionContent extends Model
{
    use HasFactory;
    
    protected $table = 'section_contents';
    public $timestamps = false;

    public function section_config()
    {
        return $this->belongsTo('App\Models\Cms\Page\SectionConfig', 'config_id');
    }

    public function descriptions()
    {
        return $this->hasMany('App\Models\Cms\Page\SectionDescription', 'section_id');
    }

    public function image_contents()
    {
        return $this->hasMany('App\Models\Cms\Page\ImageContent', 'section_id');
    }

    public function slider_contents()
    {
        return $this->hasMany('App\Models\Cms\Page\SliderContent', 'section_id');
    }

    /* public function type_contents()
    {
        return $this->hasMany('App\Models\Cms\Page\TypeContent', 'section_id');
    } */

    public function list_links()
    {
        return $this->hasMany('App\Models\Cms\Page\ListLink', 'section_id')->orderBy('display_order', 'ASC');
    }

    public function list_videos()
    {
        return $this->hasMany('App\Models\Cms\Page\ListVideo', 'section_id');
    }

    public function list_content_head()
    {
        return $this->hasMany('App\Models\Cms\Page\ListContentHead', 'section_id');
    }

    public function list_content_body()
    {
        return $this->hasMany('App\Models\Cms\Page\ListContentBody', 'section_id')->orderBy('display_order', 'DESC')->with('list_content_head');
    }

    public function list_contents()
    {
        if ($this->section_config->has_list == 1) { $i=0;
            $list_config_bodies = $this->section_config->list_config_body;
            $list_contents = [];
            foreach ($list_config_bodies as $list_config_body) { 

                $list_contents[$i]['list_config_head']   = $list_config_body->list_config_head;
                $list_contents[$i]['list_content_head']  = $list_config_body->list_config_head ? $list_config_body->list_config_head->list_content_head : null;

                $list_contents[$i]['list_config_body']   = $list_config_body;
                $list_contents[$i]['list_content_body']  = $list_config_body->list_content_body;
                $i++;
            }

            return (object) $list_contents;
        }
        return null;
    }

    public function type_contents()
    {
        if ($this->section_config->has_type == 1) {
            $type_configs = $this->section_config->type_config;
            $typeContents = [];
            foreach($type_configs as $type_config) {
                $typeContents[$type_config->id] = TypeContentService::_get_type_contents($this->id, $type_config->id, $type_config->type_id);
            }
            return (object) $typeContents;
        }
        return null;
    }
}
