<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'product_question_answers';

    public function customer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Customer', 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\General\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Ecommerce\Product\Product', 'product_id');
    }
}
