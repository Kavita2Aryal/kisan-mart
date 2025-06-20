<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderItem extends Model
{
    use HasFactory;
    
    protected $table = 'slider_items';
    public $timestamps = false;
    protected $fillable = [
        'slider_id', 'title', 'link', 'description', 'image_id', 'video_url', 'display_type', 'display_order', 'is_active'
    ];

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}