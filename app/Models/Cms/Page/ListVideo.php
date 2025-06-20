<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListVideo extends Model
{
    use HasFactory;
    
    protected $table = 'list_videos';
    public $timestamps = false;
    protected $fillable = [
        'title', 'value', 'section_id', 'video_thumbnail_id'
    ];

    public function thumbnail()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'video_thumbnail_id');
    }
}
