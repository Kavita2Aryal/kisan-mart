<?php

namespace App\Models\Addons\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventSeo extends Model
{
    use HasFactory;
    
    protected $table = 'event_seos';
    public $timestamps = false;

    public function image()
    {
        return $this->belongsTo('App\Models\Cms\ImageX', 'image_id');
    }
}
