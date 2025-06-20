<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionDescription extends Model
{
    use HasFactory;
    
    protected $table = 'section_descriptions';
    public $timestamps = false;
    protected $fillable = [
        'section_id', 'description'
    ];
}
