<?php

namespace App\Models\Addons\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;
    
    protected $table = 'blog_categories';

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    } 

    public function blogs()
    {
        return $this->hasMany('App\Models\Addons\Blog\Blog', 'category_id');
    }
}
