<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageListContentBody extends Model
{
    use HasFactory;
    
    protected $table = 'image_list_content_bodies';
    public $timestamps = false;
    protected $fillable = [
        'list_id', 'image_id', 'display_order'
    ];
	
    public function image()
    {
    	return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}
