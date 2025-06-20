<?php

namespace App\Models\Build;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListGroup extends Model
{
    use HasFactory;
    
    protected $table = 'list_groups';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
