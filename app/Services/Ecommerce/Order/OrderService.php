<?php

namespace App\Services\Ecommerce\Order;

use App\Http\Middleware\Custom\FullCMS;
use App\Mail\GiftVoucherMail;
use App\Mail\OrderMail;
use App\Models\Addons\SocialMedia;
use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use App\Models\Ecommerce\GiftVoucher\GiftVoucherSale;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\OrderBillingAddress;
use App\Models\Ecommerce\OrderShippingAddress;
use App\Models\Ecommerce\Payment\PaymentEsewa;
use App\Models\Ecommerce\Product\Product;
use App\Services\Ecommerce\Order\OrderStatusService;
use App\Services\General\Export;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Session;
use Auth;

class OrderService
{
    public static function _find($code)
    {
        return Order::where('order_code', $code)->firstOrFail();
    }

    public static function _get()
    {
        return Order::orderBy('created_at', 'DESC')->get();
    }

    public static function _get_details($uuid)
    {
        return Order::with('details.product', 'details.gift_voucher', 'exchangeRate', 'billing', 'shipping', 'customer')->where('uuid', $uuid)->first();
    }

    public static function _paging($req, $type)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);
        $status = get_list_group('order-status-save')[$type];
        $data = Order::with('exchangeRate.currency', 'customer')->select('orders.id', 'orders.order_code', 'orders.customer_id', 'orders.sub_total', 'orders.discount_amount', 'orders.delivery_charge', 'orders.vat_amount', 'orders.total', 'orders.created_at', 'orders.uuid', 'orders.exchange_rate_id', 'order_status.created_at as status_created_at', 'orders.payment_type')
                    ->Join('order_status', function ($join) use ($status) {
                        $join->on('orders.id', '=', 'order_status.order_id');
                        $join->where('order_status.status', '=', $status);
                        $join->where('order_status.is_active', '=', 10);
                    })->orderBy('orders.created_at', 'DESC');
        if ($search) { 
            $data->whereHas('customer', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('email', 'LIKE', '%'.$search.'%');
                $query->orWhere('phone', 'LIKE', '%'.$search.'%');
            });
            $data->orWhere('order_code', 'LIKE', '%'.$search.'%');
            
        }
        return $data->paginate($per_page);
    }

    public static function _confirm_order($req)
    {
        $model = self::_find($req->order_code);
        $gift_vouchers  = OrderDetail::with(['gift_voucher'])->where('order_id', $model->id)->whereNotNull('gift_voucher_id')->get();
        $status = get_list_group('order-status-save')['confirmed'];
        $model->current_status    = $status;
        if ($model->update()) {
            if (OrderStatusService::_update($model, $req, $status)) {
                self::_send_order_mail($model, 'confirmed');
                $gift_vouchers  = OrderDetail::with(['gift_voucher'])->where('order_id', $model->id)->whereNotNull('gift_voucher_id')->get();
                if(count($gift_vouchers)>0){
                    self::_gift_voucher_sale($model, $gift_vouchers);
                }
                return true;
            }
        }
        return false;
    }

    public static function _ship_order($req)
    {
        $model = self::_find($req->order_code);
        $status = get_list_group('order-status-save')['shipped'];
        $model->current_status    = $status;
        if ($model->update()) {
            if (OrderStatusService::_update($model, $req, $status)) {
                self::_send_order_mail($model, 'shipped');
                return true;
            }
        }
        return false;
    }

    public static function _deliver_order($req)
    {
        $model = self::_find($req->order_code);
        $status = get_list_group('order-status-save')['delivered'];
        $model->current_status    = $status;
        if ($model->update()) {
            if (OrderStatusService::_update($model, $req, $status)) {
                self::_send_order_mail($model, 'delivered');
                return true;
            }
        }
        return false;
    }

    public static function _cancel_order($req)
    {
        $model = self::_find($req->order_code);
        $status = get_list_group('order-status-save')['cancelled'];
        $model->current_status    = $status;
        if ($model->update()) {
            if (OrderStatusService::_update($model, $req, $status)) {
                self::_send_order_mail($model, 'cancelled');
                return true;
            }
        }
        return false;
    }

    public static function _refund_order($req)
    {
        $model = self::_find($req->order_code);
        $status = get_list_group('order-status-save')['refund'];
        $model->current_status    = $status;
        if ($model->update()) {
            if (OrderStatusService::_update($model, $req, $status)) {
                self::_send_order_mail($model, 'refund');
                return true;
            }
        }
        return false;
    }

    public static function _order_detail($uuid)
    {
        $order                   = Order::with('customer')->where(['uuid' => $uuid])->first();
        $product_details  = OrderDetail::with(['product', 'variation'])->where('order_id', $order->id)->whereNotNull('product_id')->get();
        $gift_voucher_details  = OrderDetail::with(['gift_voucher'])->where('order_id', $order->id)->whereNotNull('gift_voucher_id')->get();
        $order_billing_address   = OrderBillingAddress::with('getArea')->with('getCity')->with('getRegion')->with('getCountry')->where(['order_id' => $order->id])->first();
        $order_shipping_address  = OrderShippingAddress::with('getArea')->with('getCity')->with('getRegion')->with('getCountry')->where(['order_id' => $order->id])->first();
        return [
            'order' => $order,
            'product_details' => $product_details,
            'gift_voucher_details' => $gift_voucher_details,
            'order_billing_address' => $order_billing_address,
            'order_shipping_address' => $order_shipping_address,
        ];
    }

    public static function _confirm_items($products, $uuid)
    {
        $data = [];
        $order = self::_get_details($uuid);
        if($order)
        {
            foreach($products as $row)
            {
                $product = Product::with(['default_variant', 'variants', 'brand', 'product_categories.category', 'has_offer'])->where('id', $row['index'])->first();
                $variants = [];
                $category = [];
                $default_variant = $product->default_variant;
                $default_offer_price = get_offer_price($default_variant->selling_price, ($product->has_offer != null ? $product->has_offer->toArray() : null));
                foreach($product->variants as $variant){
                    $offer_price = get_offer_price($variant->selling_price, ($product->has_offer != null ? $product->has_offer->toArray() : null));
                    $variants[] = [
                        'sku' => $variant->sku,
                        'actual_price' => $variant->selling_price,
                        'price' => ($offer_price <= 0) ? $variant->selling_price : $offer_price,
                        'variant' => $variant->variant,
                        'is_active' => $variant->is_active
                    ];
                }
                foreach($product->product_categories as $row){
                    $category[] = $row->category->name;
                }
                $data[$product->id] = [
                    'id' => $product->id,
                    'uuid' => $product->uuid,
                    'name' => $product->name,
                    'brand' => $product->brand->name,
                    'categories' => $category,
                    'has_variant' => $product->has_variant,
                    'variant' => $variants,
                    'sku' => $default_variant->sku,
                    'actual_price' => $default_variant->selling_price,
                    'price' => ($default_offer_price <= 0) ? $default_variant->selling_price : $default_offer_price,
                ];
            }
        }
        return $data;
    }

    public static function _gift_voucher_sale($model, $gift_vouchers)
    {
        $msg_content                    = self::_get_details_for_mail($model);
        $msg_content['message']         = 'Thank you for making this purchase! Along with this email, we have sent a pdf with information about the gift voucher. You can use the gift voucher code and verification code to use your gift voucher.';
        $i = 0;
        $details = [];
        foreach($gift_vouchers as $row)
        {
            for($j=1; $j<=$row->qty; $j++){
                $i++;
                $verification_code = Str::random(6);
                $xmodel = GiftVoucherSale::create([
                    'uuid'  => Str::uuid()->toString(),
                    'order_id' => $model->id,
                    'gift_voucher_uuid' => $row->gift_voucher->uuid,
                    'verification_code' => $verification_code
                ]);
                
                $details[$i]['verification_code'] = $verification_code;
                $details[$i]['code'] = $row->gift_voucher->code;
                $details[$i]['title'] = $row->gift_voucher->title;
                $details[$i]['value'] = $row->gift_voucher->value;
                $details[$i]['start_date'] = $row->gift_voucher->start_date;
                $details[$i]['end_date'] = $row->gift_voucher->end_date;
            }
        }
        Mail::to($msg_content['client_email'])->queue(new GiftVoucherMail("Gift Voucher Purchase Confirmation", $msg_content, $details, 'gift-voucher'));
        return true;
    }
    
    public static function _get_details_for_mail($model)
    {
        $settings = [];
        $settings['admin-email'] = get_setting('admin-email');
        $settings['contact-title'] = get_setting('contact-title');
        $settings['contact-phone'] = get_setting('contact-phone');
        $settings['contact-email'] = get_setting('contact-email');
        $settings['contact-mobile'] = get_setting('contact-mobile');
        $settings['contact-address'] = get_setting('contact-address');
        $social_medias = SocialMedia::orderBy('display_order', 'ASC')->get()->toArray();

        if ($model->customer_id > 0) {
            $customer_name    = $model->customer->name;
            $customer_email   = $model->customer->email;
            $customer_phone   = $model->customer->phone;
        }
        $currency = $model->exchange_rate_id > 0 ? $model->exchangeRate->currency->currency : 'NPR';

        $msg_content                    = [];
        $msg_content['settings']        = $settings;
        $msg_content['currency']        = $currency;
        $msg_content['client_name']     = $customer_name;
        $msg_content['client_phone']    = $customer_phone;
        $msg_content['client_email']    = $customer_email;
        $msg_content['title']           = 'Dear ' . $customer_name;
        $msg_content['social_medias']   = $social_medias;

        return $msg_content;
    }
    public static function _send_order_mail($model, $status)
    {
        
        $billing    = OrderBillingAddress::where('order_id', '=', $model->id)->first();
        $shipping   = OrderShippingAddress::where('order_id', '=', $model->id)->first();

        $billing_arr = ($billing != null) ? [
            'country' => $billing->country != null ? $billing->getCountry->name : null,
            'region' => $billing->region != null ? $billing->getRegion->name : null,
            'city' => $billing->city != null ? $billing->getCity->name : null,
            'area' => $billing->area != null ? $billing->getArea->name : null,
            'address_line_1' => $billing->address_line_1 != null ? $billing->address_line_1 : null,
            'full_name' => $billing->full_name != null ? $billing->full_name : null,
            'phone_number' => $billing->phone_number != null ? $billing->phone_number : null
        ] : [];

        $shipping_arr = ($shipping != null) ? [
            'country' => $shipping->country != null ? $shipping->getCountry->name : null,
            'region' => $shipping->region != null ? $shipping->getRegion->name : null,
            'city' => $shipping->city != null ? $shipping->getCity->name : null,
            'area' => $shipping->area != null ? $shipping->getArea->name : null,
            'address_line_1' => $shipping->address_line_1 != null ? $shipping->address_line : null,
            'delivery_instructions' => $shipping->delivery_instructions != null ? $shipping->delivery_instructions : null,
            'full_name' => $shipping->full_name != null ? $shipping->full_name : null,
            'phone_number' => $shipping->phone_number != null ? $shipping->phone_number : null,
        ] : [];
        $message_to_client = '';
        $message_amount = '';
        if($status == 'confirmed' && $model->created_at != $model->updated_at){
            $payment_method = get_list_group('payment_type')[$model->payment_type];
            if($payment_method == 'ESEWA'){
                $payment = PaymentEsewa::where('order_id', $model->id)->first();
                if($payment){
                    $currency = $model->exchange_rate->currency->currency;
                    if($model->total < $payment->amount)
                    {
                        $refund_amount = $payment->amount - $model->total;
                        $message_amount = "You will receive a refund of" .$currency .' '. $refund_amount;
                    }else{
                        $remaining_amount = $model->total - $payment->amount;
                        $message_amount = "You would be required to pay".$currency .' '. $remaining_amount." as per the order adjustment.";
                    }
                }
            }   
            $message_to_client = "We've changed the details of your order accoding to our conversation. This is the most recent information about your order." . $message_amount;
        }
        $msg_content                    = self::_get_details_for_mail($model);
        $msg_content['order']           = $model;
        $msg_content['shipping']        = $shipping_arr;
        $msg_content['billing']         = $billing_arr;
        $msg_content['status']          = $status;
        if($msg_content['client_email'] != null)
        {
            $msg_content['message']         = 'Your order : <strong>' . $model->order_code . '</strong> has been ' . $status . '.' . $message_to_client;
            Mail::to($msg_content['client_email'])->queue(new OrderMail("Order has been $status ", $msg_content, 'order-status')); /* parameters: subject, message content, template to be used */
        }
        
        if($model->user_id != null && $model->user_id > 0)
        {
            $msg_content['title']           = 'A new order has been created by <strong>'. Auth::user()->name. '</strong> for customer <strong>' .$msg_content['client_name']. '</strong> with status <strong>' .$status. '</strong>' ;
            $msg_content['message']         = 'Order Code : ' . $model->order_code;

            Mail::to($msg_content['settings']['admin-email'])->queue(new OrderMail("Order has been $status ", $msg_content, 'order-status')); /* parameters: subject, message content, template to be used */
        }
    }

    public static function _format_for_csv($data)
    {
        $payment_options = get_list_group('payment_type');
        $order_status = get_list_group('order-status');
        $array_column_heading_names = [
            'A1' => 'Order Code',
            'B1' => 'Customer Name',
            'C1' => 'Customer Email',
            'D1' => 'Customer Phone',
            'E1' => 'Sub Total Amount',
            'F1' => 'Discount Amount',
            'G1' => 'Vat Amount',
            'H1' => 'Delivery Charge Amount',
            'I1' => 'Total Amount',
            'J1' => 'Payment Type',
            'K1' => 'Order Status',
            'L1' => 'Ordered On',
        ];

        $array = [];
        if ($data) {
            $i = 1; // always start this from 1
            foreach ($data as $key => $row) {
                $currency = $row->exchange_rate_id > 0 ? $row->exchangeRate->currency->currency : 'NPR';
                $i++;
                $array[$key]['A' . $i] = $row->order_code;
                $array[$key]['B' . $i] = $row->customer->name;
                $array[$key]['C' . $i] = $row->customer->email;
                $array[$key]['D' . $i] = $row->customer->phone;
                $array[$key]['E' . $i] = $currency . ' ' . number_format($row->sub_total, 2);
                $array[$key]['F' . $i] = $currency . ' ' . number_format($row->discount_amount, 2);
                $array[$key]['G' . $i] = $currency . ' ' . number_format($row->vat_amount, 2);
                $array[$key]['H' . $i] = $currency . ' ' . number_format($row->delivery_charge, 2);
                $array[$key]['I' . $i] = $currency . ' ' . number_format($row->total, 2);
                $array[$key]['J' . $i] = ($row->payment_type != null) ? $payment_options[$row->payment_type] : 'N\A';
                $array[$key]['K' . $i] = $order_status[$row->current_status];
                $array[$key]['L' . $i] = date('Y-m-d H:i:s', strtotime($row->created_at));
            }
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }
}
