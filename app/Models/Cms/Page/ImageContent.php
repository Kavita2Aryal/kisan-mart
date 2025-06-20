<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageContent extends Model
{
	use HasFactory;
    
    protected $table = 'image_contents';
    public $timestamps = false;

    protected $fillable = [
        'image_id', 'section_id', 'display_order'
    ];
	
    public function image()
    {
    	return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}
