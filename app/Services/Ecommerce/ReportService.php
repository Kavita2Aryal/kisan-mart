<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Cart;
use App\Models\Ecommerce\CheckoutStatus;
use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Product\ProductVariant;
use App\Models\Ecommerce\Wishlist;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Analytics;
use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use Carbon\Carbon;
use Spatie\Analytics\Period;

class ReportService
{
    public static function _sales($req)
    {
        $condition = '';
        $order_status = get_list_group('order-status-save');
        $cancelled_status = $order_status['cancelled'];
        $pending_status   = $order_status['pending'];
        $path = url()->current();

        $get_orders = Order::with('exchangeRate.currency')->select('id', 'exchange_rate_id', 'sub_total', 'discount_amount', 'vat_amount', 'delivery_charge', 'total', 'payment_type', DB::raw("DATE(created_at) as ordered_on"))
            ->where('current_status', '!=', $cancelled_status)
            ->where('current_status', '!=', $pending_status)
            ->orderBy('created_at', 'DESC');

        if (isset($_GET['s']) && $_GET['s'] != null && isset($_GET['e']) && $_GET['e'] != null) {
            $get_orders->whereDate('created_at', '>=', $_GET['s'])->whereDate('created_at', '<=', $_GET['e']);
        }

        $orders = $get_orders->get()->groupBy('ordered_on');
        $data = ($orders) ? self::_calculate_amount($orders) : [];
        if ($req == 'report') {
            return $data;
        }
        $result = self::_pagination($data, $req, $path);
        return ['all' => $data, 'sales' => $result];
    }

    public static function _pagination($data, $req, $path)
    {
        $page = $req->filled('page') ? $req->page : 1;
        $perPage = $req->filled('limit') ? $req->limit : 10;
        $options = [];
        $data = $data instanceof Collection ? $data : Collection::make($data);
        $result = new LengthAwarePaginator($data->forPage($page, $perPage), $data->count(), $perPage, $page, $options);
        $result->setPath($path);
        return $result;
    }

    public static function _calculate_amount($orders)
    {
        $data = [];
        foreach ($orders as $key => $order_lists) {
            $s_total = 0;
            $d_total = 0;
            $dc_total = 0;
            $v_total = 0;
            $g_total = 0;
            foreach ($order_lists as $row) {
                $currency = $row->exchange_rate_id > 0 ? $row->exchangeRate->currency->currency : 'NPR';
                $rate = $row->exchangeRate->rate;
                if ($currency != 'NPR') {
                    $subtotal = $row->sub_total * $rate;
                    $discount_amount = $row->discount_amount * $rate;
                    $delivery_charge = $row->delivery_charge * $rate;
                    $vat_amount = $row->vat_amount * $rate;
                    $total = $row->total * $rate;
                } else {
                    $subtotal = $row->sub_total;
                    $discount_amount = $row->discount_amount;
                    $delivery_charge = $row->delivery_charge;
                    $vat_amount = $row->vat_amount;
                    $total = $row->total;
                }
                $s_total += $subtotal;
                $d_total += $discount_amount;
                $dc_total += $delivery_charge;
                $v_total += $vat_amount;
                $g_total += $total;
            }
            $data[$key] = [
                's_total' => $s_total,
                'd_total' => $d_total,
                'dc_total' => $dc_total,
                'v_total' => $v_total,
                'g_total' => $g_total,
            ];
        }
        return $data;
    }

    public static function _vat_report($req)
    {
        $condition = '';
        $order_status = get_list_group('order-status-save');
        $cancelled_status = $order_status['cancelled'];
        $pending_status   = $order_status['pending'];
        $path = url()->current();

        $get_custom_orders = Order::with('exchangeRate.currency')->select('id', 'exchange_rate_id', 'vat_amount', DB::raw("DATE(created_at) as ordered_on"))
            ->where('current_status', '!=', $cancelled_status)
            ->where('current_status', '!=', $pending_status)
            ->where('vat_amount', '>', 0)
            ->orderBy('created_at', 'DESC');

        if (isset($_GET['s']) && $_GET['s'] != null && isset($_GET['e']) && $_GET['e'] != null) {
            $get_orders->whereDate('created_at', '>=', $_GET['s'])->whereDate('created_at', '<=', $_GET['e']);
        }

        $orders = $get_orders->get()->groupBy('ordered_on');

        $data = ($orders) ? self::_calculate_vat_amount($orders) : [];
        if ($req == 'report') {
            return $data;
        }
        $result = self::_pagination($data, $req, $path);
        return ['all' => $data, 'vat' => $result];
    }

    public static function _calculate_vat_amount($orders)
    {
        $data = [];
        foreach ($orders as $key => $order_lists) {
            $s_total = 0;
            $d_total = 0;
            $dc_total = 0;
            $v_total = 0;
            $g_total = 0;
            foreach ($order_lists as $row) {
                $currency = $row->exchange_rate_id > 0 ? $row->exchangeRate->currency->currency : 'NPR';
                $rate = $row->exchangeRate->rate;
                if ($currency != 'NPR') {
                    $vat_amount = $row->vat_amount * $rate;
                } else {
                    $vat_amount = $row->vat_amount;
                }
                $v_total += $vat_amount;
            }
            $data[$key] = [
                'v_total' => $v_total,
            ];
        }
        return $data;
    }

    public static function _best_seller($req)
    {
        $condition = '';
        $order_status = get_list_group('order-status-save');
        $cancelled_status = $order_status['cancelled'];
        $pending_status   = $order_status['pending'];
        $path = url()->current();

        $get_orders = Order::with('exchangeRate.currency')->select('orders.id', 'orders.exchange_rate_id', 'orders.payment_type', 'order_details.qty', 'order_details.price', 'products.name', 'products.uuid', 'web_alias.alias')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('web_alias', 'web_alias.product_id', '=', 'products.id')
            ->where('current_status', '!=', $cancelled_status)
            ->where('current_status', '!=', $pending_status);

        if (isset($req->search) && $req->search != null) {
            $get_orders->where('products.name', 'LIKE', '%' . $req->search . '%');
        }   
        $orders = $get_orders->get()->groupBy('uuid');

        $data = ($orders) ? self::_calculate_price($orders) : [];
    
        $keys = array_column($data, 'qty');
        array_multisort($keys, SORT_DESC, $data);
        
        if ($req == 'top_result') {
            $data = array_slice($data, 0, 10);
            return $data;
        }

        if ($req == 'report') {
            return $data;
        }
        $best_seller_data = self::_pagination($data, $req, $path);
        return [ 'all' => $data, 'best_seller_data' => $best_seller_data];
    }

    public static function _product_category($req)
    {
        $condition1 = '';
        $condition2 = '';
        $query         = '';
        $order_status = get_list_group('order-status-save');
        $cancelled_status = $order_status['cancelled'];
        $pending_status   = $order_status['pending'];
        $path = url()->current();
        $get_orders = Order::with('exchangeRate.currency')->select('orders.id', 'orders.exchange_rate_id', 'orders.payment_type', 'order_details.qty', 'order_details.price', 'categories.name', 'categories.uuid', 'categories.slug as alias')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('product_categories', 'product_categories.product_id', '=', 'products.id')
            ->join('categories', 'product_categories.category_id', '=', 'categories.id')
            ->distinct('product_categories.product_id')
            ->where('current_status', '!=', $cancelled_status)
            ->where('current_status', '!=', $pending_status);

        if (isset($req->search) && $req->search != null) {
            $get_orders->where('categories.name', 'LIKE', '%' . $req->search . '%');
        }   
        $orders = $get_orders->get()->groupBy('uuid');

        $data = ($orders) ? self::_calculate_price($orders) : [];
        
        $keys = array_column($data, 'qty');
        array_multisort($keys, SORT_DESC, $data);
        
        if ($req == 'top_result') {
            $data = array_slice($data, 0, 10);
            return $data;
        }
        
        if ($req == 'report') {
            return $data;
        }
        $product_category = self::_pagination($data, $req, $path);
        return [ 'all' => $data, 'product_category' => $product_category];
    }
    
    public static function _product_brand($req)
    {
        $condition1 = '';
        $condition2 = '';
        $query         = '';
        $order_status = get_list_group('order-status-save');
        $cancelled_status = $order_status['cancelled'];
        $pending_status   = $order_status['pending'];
        $path = url()->current();
        $get_orders = Order::with('exchangeRate.currency')->select('orders.id', 'orders.exchange_rate_id', 'orders.payment_type', 'order_details.qty', 'order_details.price', 'brands.name', 'brands.uuid', 'brands.slug as alias')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('brands', 'brand_id', '=', 'brands.id')
            ->where('current_status', '!=', $cancelled_status)
            ->where('current_status', '!=', $pending_status);

        if (isset($req->search) && $req->search != null) {
            $get_orders->where('brand.name', 'LIKE', '%' . $req->search . '%');
        }   
        $orders = $get_orders->get()->groupBy('uuid');

        $data = ($orders) ? self::_calculate_price($orders) : [];
        
        $keys = array_column($data, 'qty');
        array_multisort($keys, SORT_DESC, $data);
        
        if ($req == 'top_result') {
            $data = array_slice($data, 0, 10);
            return $data;
        }
        
        if ($req == 'report') {
            return $data;
        }
        $product_brand = self::_pagination($data, $req, $path);
        return [ 'all' => $data, 'product_brand' => $product_brand];
    }

    public static function _calculate_price($orders)
    {
        $qty = 0;
        $data = [];
        foreach ($orders as $key => $lists) {
            $price = 0;
            $qty = 0;
            foreach ($lists as $row) {
                $currency = $row->exchange_rate_id > 0 ? $row->exchangeRate->currency->currency : 'NPR';
                $rate = $row->exchangeRate->rate;
                if ($currency != 'NPR') {
                    $price = $row->price * $rate;
                } else {
                    $price = $row->price;
                }
                $name = $row->name;
                $alias = $row->alias;
                $qty += $row->qty;
            }
            $data[$key] = [
                'price' => $price * $qty,
                'name' => $name,
                'alias' => $alias,
                'qty' => $qty,
            ];
        }
        return $data;
    }

    public static function _most_searched_keyword($req)
    {
        $content = self::_get_most_searched_keyword();
        $content = array_slice($content, 0, 100);
        $path = url()->current();
        $data = self::_pagination($content, $req, $path);
        return $data;
    }

    public static function _get_most_searched_keyword()
    {
        $data = get_hit('search');
        $text = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $data);
        $content = [];
        $i = 0;
        if ($text) {
            $drow = explode("\n", $text);
            if ($drow) {
                foreach ($drow as $ddrow) {
                    if ($ddrow) {
                        $x = explode('||', $ddrow);
                        if (isset($content[$x[2]])) {
                            $content[$x[2]] += 1;
                        } else {
                            $content[$x[2]] = 1;
                        }

                        $i++;
                    }
                }

                arsort($content);
            }
        }
        return $content;
    }

    public static function _product_view($req)
    {
        $url = url()->current();
        if(isset($_GET['s']) && $_GET['s'] != null && isset($_GET['e']) && $_GET['e'] != null){
            $start = Carbon::parse($_GET['s']);
            $end = Carbon::parse($_GET['e']);
            $s = $start->format('Y-m-d');
            $e = $end->format('Y-m-d');
        }else{
            $start = Carbon::parse(now()->subMonth(1)->format('Y-m-d'));
            $end = Carbon::parse(now()->format('Y-m-d'));
            $s = '';
            $e = '';
        }
        $page = ($req->has('page')) ? $req->page : 1;
        $limit = ($req->has('limit')) ? $req->limit : 10;

        $start_index = ($page > 1) ? (($page * $limit) - ($limit - 1)) : $page;
        $url = $url.'?s='.$s.'&e='.$e.'&limit='.$limit; 
        $products = Analytics::performQuery(
                Period::create($start, $end), //Period::months(3)
                'ga:pageViews',
                [    
                    'dimensions' => 'ga:pagePath,ga:pageTitle',
                    'metrics' => 'ga:pageviews',
                    'sort' => '-ga:pageviews',
                    'max-results' => $limit,
                    'start-index' => $start_index,
                    'filters' => 'ga:pagePath=~/p/'
                ]
            );
        return ['products' => $products, 'url' => $url, 'current_page' => $page];
    }

    public static function _cart_report($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Cart::select('carts.product_uuid as product_uuid', 'products.name as product_name', 'web_alias.alias as product_alias')
            ->selectRaw('sum(qty) as count')
            ->join('products', 'products.uuid', '=', 'carts.product_uuid')
            ->join('web_alias', 'web_alias.product_id', '=', 'products.id')
            ->groupBy('product_uuid', 'product_name', 'product_alias');
            
        if ($search) { 
            $data->where('products.name', 'LIKE', '%' . $paging['search'] . '%');
        }
        return $data->paginate($per_page);
    }

    public static function _cart_customer($req)
    {
        $carts = Cart::with('customer', 'product', 'variation')->where('product_uuid', $req->index)->get();
        return $carts;
    }

    public static function _wishlist_report($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Wishlist::select('wishlists.product_uuid as product_uuid', 'products.name as product_name', 'web_alias.alias as product_alias')
            ->selectRaw('count(product_uuid) as count')
            ->join('products', 'products.uuid', '=', 'wishlists.product_uuid')
            ->join('web_alias', 'web_alias.product_id', '=', 'products.id')
            ->groupBy('product_uuid', 'product_name', 'product_alias');
            
        if ($search) { 
            $data->where('products.name', 'LIKE', '%' . $paging['search'] . '%');
        }
        return $data->paginate($per_page);
    }

    public static function _wishlist_customer($req)
    {
        $wishlists = Wishlist::with('customer')->where('product_uuid', $req->index)->get();
        return $wishlists;
    }

    public static function _cart_abandon_report($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = CheckoutStatus::select('checkout_status.customer_id as customer_id', 'customers.name', 'customers.email', 'customers.phone', 'customers.uuid as customer_uuid', DB::raw('COUNT(customer_id) as count'), DB::raw('MAX(date) as latest_date'))
            ->join('customers', 'customers.id', '=', 'customer_id')
            ->whereDate('date', '<', date('Y-m-d'))
            ->groupBy('customer_id', 'customers.name', 'customers.email', 'customers.phone', 'customer_uuid')
            ->orderBy('date', 'ASC');

        if (isset($_GET['s']) && $_GET['s'] != null && isset($_GET['e']) && $_GET['e'] != null) {
            $data->whereDate('date', '>=', $_GET['s'])->whereDate('date', '<=', $_GET['e']);
        }
        if ($search) {
            $paging['search'] = filter_var($search, FILTER_SANITIZE_STRING);
            $data->where('customers.name', 'LIKE', '%' . $search . '%');
            $data->orWhere('customers.email', 'LIKE', '%' . $search . '%');
            $data->orWhere('customers.phone', 'LIKE', '%' . $search . '%');
        }
        return $data->paginate($per_page);
    }

    public static function _cart_abandon_details($id)
    {
        $data = CheckoutStatus::with('customer')->select('cart_details', 'customer_id', 'date')
            ->where('customer_id', $id)
            ->whereDate('date', '<', date('Y-m-d'))
            ->orderBy('date', 'DESC')
            ->get();

        $details = [];
        $result = [];
        $customer = [
            'name' => $data[0]->customer->name,
            'email' => $data[0]->customer->email,
            'phone' => $data[0]->customer->phone,
        ];
        foreach($data as $row)
        {
            $cart_details = json_decode($row->cart_details, true);
            foreach($cart_details as $c_row){
                if(isset($c_row['product_uuid'])){
                    $product = Product::with('alias')->where('uuid', $c_row['product_uuid'])->first();
                    $variant = ProductVariant::where('sku', $c_row['sku'])->first();
    
                    $details[] = [
                        'name' => $product->name,
                        'alias' => $product->alias->alias,
                        'variant' => $variant->variant,
                        'qty' => $c_row['qty']
                    ];
                }else{
                    $gift_voucher = GiftVoucher::with('alias')->where('uuid', $c_row['gift_voucher_uuid'])->first();
                    $details[] = [
                        'name' => $gift_voucher->title,
                        'alias' => $gift_voucher->alias->alias,
                        'qty' => $c_row['qty']
                    ];
                }
            }
            $result[] = [
                'date' => $row->date,
                'details' => $details
            ];
        }
        return [
            'customer' => $customer,
            'result' => $result
        ];
    }

    public static function _cash_on_delivery($req)
    {
        $condition = '';
        $order_status = get_list_group('order-status-save');
        $cancelled_status = $order_status['cancelled'];
        $pending_status   = $order_status['pending'];
        $path = url()->current();

        $payment_type = get_list_group('payment_type');

        $get_orders = Order::with('exchangeRate.currency')->select('id', 'exchange_rate_id', 'sub_total', 'discount_amount', 'vat_amount', 'delivery_charge', 'total', 'payment_type', DB::raw("DATE(created_at) as ordered_on"))
            ->where('current_status', '!=', $cancelled_status)
            ->where('current_status', '!=', $pending_status)
            ->where('payment_type', '==', $payment_type[1])
            ->orderBy('created_at', 'DESC');

        if (isset($_GET['s']) && $_GET['s'] != null && isset($_GET['e']) && $_GET['e'] != null) {
            $get_orders->whereDate('created_at', '>=', $_GET['s'])->whereDate('created_at', '<=', $_GET['e']);
        }

        $orders = $get_orders->get()->groupBy('ordered_on');
        $data = ($orders) ? self::_calculate_amount($orders) : [];
        if ($req == 'report') {
            return $data;
        }
        $result = self::_pagination($data, $req, $path);
        return ['all' => $data, 'cash_on_delivery' => $result];
    }
}