<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterClient extends Model
{
    use HasFactory;
    
    protected $table = 'newsletter_clients';
    protected $dates = [ 'created_at', 'updated_at' ];
    protected $fillable = [
    	'email'
    ];
}
