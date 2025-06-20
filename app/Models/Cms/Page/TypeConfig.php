<?php

namespace App\Models\Cms\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeConfig extends Model
{
    use HasFactory;
    
    protected $table = 'type_configs';
    public $timestamps = false;
}
