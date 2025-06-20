<?php

namespace App\Models\Addons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;
    
    protected $table = 'contact_messages';
    protected $dates = [ 'created_at', 'updated_at' ];
    protected $fillable = [
    	'name', 'email', 'phone', 'subject', 'message'
    ];
}
