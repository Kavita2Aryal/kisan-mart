<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;
    
    protected $table = 'faqs';
    
    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
