<?php

namespace App\Models\Cms\Popup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupPage extends Model
{
    use HasFactory;

    protected $table = 'popup_pages';
    public $timestamps = false;
    protected $fillable = [
        'popup_id', 'page_id'
    ];
}
