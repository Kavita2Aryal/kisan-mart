<?php

namespace App\Models\Addons\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Cms\ImageX;

class NewsContent extends Model
{
    use HasFactory;
    
    protected $table = 'news_contents';
    public $timestamps = false;
    protected $fillable = [
        'news_id', 'description', 'image_id', 'video_url', 'image_gallery', 'display_type', 'display_order'
    ];

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }

    public function image_gallery()
    {
        if ($this->display_type == 2) {
            $ids = json_decode($this->image_gallery, true);
            if ($images = ImageX::whereIn('id', $ids)->get()) {
                $gallery = [];
                $images = array_column($images->toArray(), null, 'id');
                foreach ($ids as $id) {
                    $gallery[] = (object) $images[$id];
                }
                return $gallery;
            }
        }
        return [];
    }
}