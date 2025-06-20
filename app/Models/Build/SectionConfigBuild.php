<?php

namespace App\Models\Build;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionConfigBuild extends Model
{
    use HasFactory;
    
    protected $table = 'section_config_builds';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function format()
    {
        return [
            'uuid'          => $this->uuid,
            'index'         => $this->id,
            'filename'      => $this->filename,
            'styles'        => !empty($this->styles) ? json_decode($this->styles, true) : [],
            'scripts'       => !empty($this->scripts) ? json_decode($this->scripts, true) : [],
            'config'        => json_decode($this->config, true),
            'type_config'   => !empty($this->type_config) ? json_decode($this->type_config, true) : [],
            'list_config'   => !empty($this->list_config) ? json_decode($this->list_config, true) : [],
            'updated_at'    => $this->updated_at->format('Y-m-d'),
            'user'          => $this->user->name
        ];
    }

    public static function single_format($config)
    {
        return [
            'uuid'          => $config['uuid'],
            'index'         => $config['id'],
            'filename'      => $config['filename'],
            'styles'        => !empty($config['styles']) ? json_decode($config['styles'], true) : [],
            'scripts'       => !empty($config['scripts']) ? json_decode($config['scripts'], true) : [],
            'config'        => json_decode($config['config'], true),
            'type_config'   => !empty($config['type_config']) ? json_decode($config['type_config'], true) : [],
            'list_config'   => !empty($config['list_config']) ? json_decode($config['list_config'], true) : [],
            'updated_at'    => $config['updated_at'],
            'user'          => $config['user']['name']
        ];
    }
}
