<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeContent extends Model
{
    use HasFactory;
    
    protected $table = 'type_contents';
    public $timestamps = false;
}
