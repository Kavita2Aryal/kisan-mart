<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShippingAddress extends Model
{
    use HasFactory;

    protected $table = 'order_shipping_addresses';

    protected $fillable = [
        'full_name','address_line_1','phone_number','address_line_2','area','region','city','country','zip', 'order_id', 'delivery_instructions'
    ]; 

    public function getCountry()
    {
        return $this->belongsTo('App\Models\Ecommerce\Country', 'country');
    }

    public function getCity()
    {
        return $this->belongsTo('App\Models\Ecommerce\City', 'city');
    }

    public function getRegion()
    {
        return $this->belongsTo('App\Models\Ecommerce\Region', 'region');
    }

    public function getArea()
    {
        return $this->belongsTo('App\Models\Ecommerce\Area', 'area');
    }
}
