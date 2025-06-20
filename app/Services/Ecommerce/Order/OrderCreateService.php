<?php
namespace App\Services\Ecommerce\Order;

use App\Models\Ecommerce\Area;
use App\Models\Ecommerce\Customer;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\Order\OrderProductSelected;
use App\Models\Ecommerce\Order\OrderStatus;
use App\Models\Ecommerce\OrderBillingAddress;
use App\Models\Ecommerce\OrderShippingAddress;
use App\Models\Ecommerce\Product\Product;
use Auth;
use Illuminate\Support\Str;

class OrderCreateService
{
    public static function _get()
    {
        return OrderProductSelected::with(['product.product_categories.category', 'product.variants', 'product.brand', 'variation'])->where('user_id', Auth::user()->id)->get()->map->_formatting()->toArray();
    }

    public static function _save_selected_items($products)
    {
        $batch = [];
        $selected_products = OrderProductSelected::select('product_id')->where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
        foreach($products as $row)
        {
            $product = Product::with(['default_variant', 'has_offer'])->where('id', $row['index'])->first();
            $has_product = false;
            if ($product->has_variant == 0 && in_array($row['index'], $selected_products)) {
                $has_product = true;
            }
            if(!$has_product){
                $variant = $product->default_variant;
                $offer_price = get_offer_price($variant->selling_price, ($product->has_offer != null ? $product->has_offer->toArray() : null));
                $batch[] = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id,
                    'product_sku' => $variant->sku,
                    'qty' => 1,
                    'price' => ($offer_price <= 0) ? $variant->selling_price : $offer_price,
                    'actual_price' => $variant->selling_price
                ];
            }
        } 
        if (isset($batch) && !empty($batch)) {
            OrderProductSelected::insert($batch);
            return true;
        }
        return false;
    }

    public static function _remove_selected_items($products)
    {
        OrderProductSelected::where('user_id', Auth::user()->id)->whereIn('id', $products)->delete();
        return true;
    }

    public static function _x_update_selected_items($req)
    {
        $model = OrderProductSelected::where('user_id', Auth::user()->id)->where('id', $req->product_id)->first();
        if(!$model) { return false; }
        $model->qty = $req->qty;
        $model->actual_price = $req->actual_price;
        $model->price = $req->price;
        $model->product_sku = $req->sku;

        return $model->update() ? true : false;
    }

    public static function _update_selected_items($products)
    {
        $batch = [];
        OrderProductSelected::where('user_id', Auth::user()->id)->delete();
        foreach($products as $row){
            $batch[] = [
                'user_id' => Auth::user()->id,
                'product_id' => $row['product_id'],
                'product_sku' => $row['sku'],
                'qty' => $row['qty'],
                'price' => $row['price'],
                'actual_price' => $row['actual_price']
            ];
        }
        if (isset($batch) && !empty($batch)) {
            OrderProductSelected::insert($batch);
            return true;
        }
    }

    public static function _calculate_total($products)
    {
        $subtotal = 0.00;
        $total = 0.00;
        $delivery_charge = 0.00;
        $discount_amount = 0.00;
        foreach($products as $product)
        {
            $subtotal += $product['price'] * $product['qty'];
        }
        $vat = self::_calculate_vat_amount($subtotal);
        $total = $subtotal + $vat['amount'] + $delivery_charge - $discount_amount;
        return [
            'subtotal' => $subtotal,
            'vat_amount' => $vat['amount'],
            'vat_rate' => $vat['rate'],
            'discount_amount' => $discount_amount,
            'delivery_charge' => $delivery_charge,
            'total' => $total,
        ];
    }

    public static function _calculate_vat_amount($subtotal)
    {
        $vat_applicable = get_setting('vat-applicable');
        $vat_amount = 0;
        $vat_percentage = null;
        if ($vat_applicable == "on") {
            $vat_percentage = get_setting('vat-rate');
            $vat_amount = $subtotal * ($vat_percentage / 100);
        }
        return $vat = ['rate' => $vat_percentage, 'amount' => $vat_amount];
    }

    public static function _storing($req)
    {
        $customer = Customer::select('id', 'name', 'email', 'phone')->where('id', $req->customer_id)->first();
        $products = self::_get();
        $data = self::_calculate_total($products);
        $delivery_charge = self::_calculate_delivery_amount($data['subtotal'], $req->shipping);
        $total = $data['subtotal'] + $delivery_charge - $data['discount_amount'] + $data['vat_amount'];
        $order_data   = [
            'customer_id'       => $customer->id,
            'order_code'        => 'OC-S-' . time(),
            'uuid'              => Str::uuid()->toString(),
            'exchange_rate_id'  => 1,
            'sub_total'         => $data['subtotal'],
            'total'             => $total,
            'discount_amount'   => $data['discount_amount'],
            'delivery_charge'   => $delivery_charge,
            'vat_rate'          => $data['vat_rate'] ?? 0,
            'vat_amount'        => $data['vat_amount'],
            'current_status'    => $req->order_status,
            'promo_code'        => 0,
            'gift_voucher'      => 0,
            'gift_voucher_option'      => null,
            'payment_type'      => $req->payment_type,
            'user_id'           => Auth::user()->id
        ];
        $order = Order::create($order_data);
        if ($order) {
            $order_id       = $order->id;

            foreach ($products as $row) {
                $batch[] = [
                    'order_id'          => $order_id,
                    'product_id'        => $row['product_id'],
                    'gift_voucher_id'   => null,
                    'requested_qty'     => $row['qty'],
                    'qty'               => $row['qty'],
                    'price'             => $row['price'],
                    'actual_price'      => $row['actual_price'],
                    'product_sku'       => $row['sku']
                ];
                $product_ids[] = [
                    'id' => $row['product_id'],
                    'sku' => $row['sku']
                ];
            }
            if (isset($batch)) {
                OrderDetail::insert($batch);
    
                $order = Order::where('id', $order_id)->first();
                
                OrderStatus::create(['order_id' => $order_id, 'status' => $req->order_status, 'is_active' => 10, 'user_id' => Auth::user()->id]);
                $detail = self::get_billing_shipping_details($req, $customer, $order_id);
                $status = strtolower(get_list_group('order-status')[$req->order_status]);
                OrderService::_send_order_mail($order, $status);
                if (count($product_ids) > 0) {
                    foreach ($product_ids as $d) {
                        OrderProductSelected::where('user_id', Auth::user()->id)->where(['product_id' => $d['id'], 'product_sku' => $d['sku']])->delete();
                    }
                }
            }
            return $status;
        }
        return false;
    }

    public static function get_billing_shipping_details($req, $customer, $order_id)
    {
        $billing = $req->billing;
        $shipping = $req->shipping;

        $shipping_details = [];
        $billing_details = [];
        if($shipping['country'] != null){
            $shipping_details = [
                'order_id'                  => $order_id,
                'full_name'                 => $customer->name,
                'phone_number'              => $customer->phone,
                'address_line_1'            => isset($shipping['address_line_1']) ? $shipping['address_line_1'] : null,
                'area'                      => isset($shipping['area']) ? $shipping['area'] : null,
                'city'                      => isset($shipping['city']) ? $shipping['city'] : null,
                'region'                    => isset($shipping['region']) ? $shipping['region'] : null,
                'country'                   => isset($shipping['country']) ? $shipping['country'] : null,
                'delivery_instructions'     => $shipping['delivery_instructions'],
                'zip'                       => isset($shipping['zip']) ? $shipping['zip'] : null,
                'is_active'                 => 10
            ];
            $billing_details = [
                'order_id'                  => $order_id,
                'full_name'                 => $customer->name,
                'phone_number'              => $customer->phone,
                'address_line_1'            => isset($req->billing_as_shipping) ? $shipping['address_line_1'] : $billing['address_line_1'],
                'area'                      => isset($req->billing_as_shipping) ? $shipping['area'] : $billing['area'],
                'city'                      => isset($req->billing_as_shipping) ? $shipping['city'] : $billing['city'],
                'region'                    => isset($req->billing_as_shipping) ? $shipping['region'] : $billing['region'],
                'country'                   => isset($req->billing_as_shipping) ? $shipping['country'] : $billing['country'],
                'zip'                       => isset($req->billing_as_shipping) ? $shipping['zip'] : $billing['zip'],
                'is_active'                 => 10
            ];
            OrderBillingAddress::create($shipping_details);
            OrderShippingAddress::create($billing_details);
        }
        return true;
    }

    public static function _calculate_delivery_amount($subtotal, $shipping)
    {
        $delivery_charge = 0;
        $area_id = isset($shipping['area']) ? $shipping['area'] : null;
        if ($area_id) {
            $area = Area::where('id', $area_id)->first();
            if ($area->condition_amount <= $subtotal && $area->delivery_charge > 0) {
                $delivery_charge = $area->delivery_charge;
            }
        }
        return $delivery_charge;
    }
}