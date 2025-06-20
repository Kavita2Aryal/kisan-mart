<?php

namespace App\Models\Ecommerce\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionProduct extends Model
{
    use HasFactory;
    protected $table = 'collection_products';
    public $timestamps = false;
    protected $fillable = [
        'collection_id', 'product_id'
    ];
}
