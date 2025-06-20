<?php

namespace App\Models\Ecommerce\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'exchange_rate_id', 'uuid', 'customer_id', 'order_code', 'discount_amount', 'vat_amount', 'delivery_charge', 'sub_total', 'total', 'promo_code', 'gift_voucher','current_status', 'payment_type', 'gift_voucher_option', 'user_id'
    ];
    
    public function customer()
    {
        return $this->belongsTo('App\Models\Ecommerce\Customer', 'customer_id');
    }

    public function details()
    {
        return $this->hasMany('App\Models\Ecommerce\Order\OrderDetail', 'order_id');
    }

    public function billing()
    {
        return $this->hasOne('App\Models\Ecommerce\OrderBillingAddress', 'order_id');
    }

    public function shipping()
    {
        return $this->hasOne('App\Models\Ecommerce\OrderShippingAddress', 'order_id');
    }

    public function getStatuses()
    {
        return $this->hasMany('App\Models\Ecommerce\Order\OrderStatus', 'order_id');
    }

    public function getCurrentStatus()
    {
        return $this->getStatuses()->where('is_active', 10)->first();
    }

    public function cancelled_order_details()
    {
        return $this->hasMany('App\Models\Ecommerce\Order\CancelOrderDetail', 'order_id');
    }

    public function exchangeRate()
    {
        return $this->belongsTo('App\Models\Ecommerce\ExchangeRate', 'exchange_rate_id', 'id');
    }

    public function getPromoCode()
    {
        return $this->belongsTo('App\Models\Ecommerce\PromoCode\PromoCode', 'promo_code', 'id');
    }

    public function getGiftVoucher()
    {
        return $this->belongsTo('App\Models\Ecommerce\GiftVoucher\GiftVoucher', 'gift_voucher', 'id');
    }
}
