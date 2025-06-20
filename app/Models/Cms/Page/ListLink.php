<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListLink extends Model
{
    use HasFactory;
    
    protected $table = 'list_links';
    public $timestamps = false;
    protected $fillable = [
        'title', 'value', 'section_id', 'display_type', 'display_order'
    ];
}
