<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'effective_date', 'is_active', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }
}
