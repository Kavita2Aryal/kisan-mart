<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;
    
    protected $table = 'sliders';
    
    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Cms\SliderItem', 'slider_id')->orderBy('display_order');
    }
}