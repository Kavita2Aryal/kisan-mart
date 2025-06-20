<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderContent extends Model
{
    use HasFactory;
    
    protected $table = 'slider_contents';
    public $timestamps = false;
    protected $fillable = [
        'slider_id', 'section_id'
    ];
}
