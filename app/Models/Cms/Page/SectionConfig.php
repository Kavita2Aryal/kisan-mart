<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionConfig extends Model
{
	use HasFactory;
    
    protected $table = 'section_configs';
    public $timestamps = false;

    public function list_config_body()
    {
        return $this->hasMany('App\Models\Cms\Page\ListConfigBody', 'config_id');
    }

    public function list_config_head()
    {
        return $this->hasMany('App\Models\Cms\Page\ListConfigHead', 'config_id');
    }

    public function type_config()
    {
        return $this->hasMany('App\Models\Cms\Page\TypeConfig', 'config_id');
    }
}
