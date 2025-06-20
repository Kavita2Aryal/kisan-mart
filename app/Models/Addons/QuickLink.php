<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuickLink extends Model
{
    use HasFactory;
    
    protected $table = 'quick_links';
    protected $fillable = [
    	'link'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}