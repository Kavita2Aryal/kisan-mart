<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Cart;
use App\Models\Ecommerce\CheckoutStatus;
use App\Models\Ecommerce\Wishlist;
use Illuminate\Support\Facades\DB;
use Analytics;
use Carbon\Carbon;
use Spatie\Analytics\Period;

class ReportCsvService
{
    public static function _format_for_product_view_csv()
    {
        $data = Analytics::performQuery(
            Period::months(3), //Period::months(3)
            'ga:pageViews',
            [    
                'dimensions' => 'ga:pagePath,ga:pageTitle',
                'metrics' => 'ga:pageviews',
                'sort' => '-ga:pageviews',
                'max-results' => 100,
                'filters' => 'ga:pagePath=~/p/'
            ]
        );
        $array_column_heading_names = [
            'A1' => 'Product Name',
            'B1' => 'Product Alias',
            'C1' => 'View Count'
        ];
        $domain = rtrim(get_setting('website-domain'), '/');
        $array = [];
        if ($data) {
            $i = 1; // always start this from 1
            foreach ($data as $key => $row) {
                $i++;
                $array[$key]['A' . $i] = $row[1];
                $array[$key]['B' . $i] = $domain . $row[0];
                $array[$key]['C' . $i] = $row[2];
            }
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_most_searched_keyword_csv()
    {
        $data = ReportService::_get_most_searched_keyword();
        $array_column_heading_names = [
            'A1' => 'Keywords',
            'B1' => 'Searched Count'
        ];
        $domain = get_setting('website-domain');
        $array = [];
        if ($data) {
            $i = 1; // always start this from 1
            foreach ($data as $key => $row) {
                $i++;
                $array[$key]['A' . $i] = $key;
                $array[$key]['B' . $i] = $row;
            }
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_sales_csv()
    {
        $data = ReportService::_sales('report');
        $array_column_heading_names = [
            'A1' => 'Date',
            'B1' => 'Sub Total(NPR)',
            'C1' => 'Discount Amount(NPR)',
            'D1' => 'Delivery Charge(NPR)',
            'E1' => 'Total(NPR)',
        ];
        $array = [];
        $t_sub_total = 0;
        $t_discount_amount = 0;
        $t_vat_amount = 0;
        $t_delivery_charge = 0;
        $t_total_amount = 0;
        if ($data) {
            $i = 1; // always start this from 1
            $x = 0;
            foreach ($data as $key => $row) {
                $i++;
                $t_sub_total += $row['s_total'];
                $t_discount_amount += $row['d_total'];
                $t_delivery_charge += $row['dc_total'];
                $t_vat_amount += $row['v_total'];
                $t_total_amount += $row['g_total'];

                $array[$x]['A' . $i] = date('Y-m-d', strtotime($key));
                $array[$x]['B' . $i] = number_format($row['s_total'], 2);
                $array[$x]['c' . $i] = number_format($row['d_total'], 2);
                $array[$x]['D' . $i] = number_format($row['dc_total'], 2);
                $array[$x]['E' . $i] = number_format($row['g_total'], 2);
                $x++;
            }
            $i++;
            $array[$x]['A' . $i] = 'Grand Total';
            $array[$x]['B' . $i] = 'NPR' . number_format($t_sub_total, 2);
            $array[$x]['c' . $i] = 'NPR' . number_format($t_discount_amount, 2);
            $array[$x]['D' . $i] = 'NPR' . number_format($t_delivery_charge, 2);
            $array[$x]['E' . $i] = 'NPR' . number_format($t_total_amount, 2);
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_vat_csv()
    {
        $data = ReportService::_vat_report('report');
        $array_column_heading_names = [
            'A1' => 'Date',
            'B1' => 'VAT Amount(NPR)'
        ];
        $array = [];
        $t_vat_amount = 0;
        if ($data) {
            $i = 1; // always start this from 1
            $x = 0;
            foreach ($data as $key => $row) {
                $i++;
                $t_vat_amount += $row['v_total'];

                $array[$x]['A' . $i] = date('Y-m-d', strtotime($key));
                $array[$x]['B' . $i] = number_format($row['v_total'], 2);
                $x++;
            }
            $i = $i++;
            $array[$x]['A' . $i] = 'Grand Total';
            $array[$x]['B' . $i] = 'NPR' . number_format($t_vat_amount, 2);
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_best_seller_csv()
    {
        $data = ReportService::_best_seller('report');
        $array_column_heading_names = [
            'A1' => 'Product Name',
            'B1' => 'Sold Quantity',
            'C1' => 'Total Sales(NPR)'
        ];
        $array = [];
        $t_total_qty = 0;
        $t_total_amount = 0;
        if ($data) {
            $i = 1; // always start this from 1
            $x = 0;
            foreach ($data as $key => $row) {
                $i++;
                $t_total_qty += $row['qty'];
                $t_total_amount += $row['price'];

                $array[$x]['A' . $i] = $row['name'];
                $array[$x]['B' . $i] = $row['qty'];
                $array[$x]['c' . $i] = number_format($row['price'], 2);
                $x++;
            }
            $i = $i++;
            $array[$x]['A' . $i] = 'Total';
            $array[$x]['B' . $i] = $t_total_qty;
            $array[$x]['c' . $i] = 'NPR ' . number_format($t_total_amount, 2);
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_product_category_csv()
    {
        $data = ReportService::_product_category('report');
        $array_column_heading_names = [
            'A1' => 'Category Name',
            'B1' => 'Sold Quantity',
            'C1' => 'Total Sales(NPR)'
        ];
        $array = [];
        $t_total_qty = 0;
        $t_total_amount = 0;
        if ($data) {
            $i = 1; // always start this from 1
            $x = 0;
            foreach ($data as $key => $row) {
                $i++;
                $t_total_qty += $row['qty'];
                $t_total_amount += $row['price'];

                $array[$x]['A' . $i] = $row['name'];
                $array[$x]['B' . $i] = $row['qty'];
                $array[$x]['c' . $i] = number_format($row['price'], 2);
                $x++;
            }
            $i = $i++;
            $array[$x]['A' . $i] = 'Total';
            $array[$x]['B' . $i] = $t_total_qty;
            $array[$x]['c' . $i] = 'NPR ' . number_format($t_total_amount, 2);
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_product_brand_csv()
    {
        $data = ReportService::_product_brand('report');
        $array_column_heading_names = [
            'A1' => 'Brand Name',
            'B1' => 'Sold Quantity',
            'C1' => 'Total Sales(NPR)'
        ];
        $array = [];
        $t_total_qty = 0;
        $t_total_amount = 0;
        if ($data) {
            $i = 1; // always start this from 1
            $x = 0;
            foreach ($data as $key => $row) {
                $i++;
                $t_total_qty += $row['qty'];
                $t_total_amount += $row['price'];

                $array[$x]['A' . $i] = $row['name'];
                $array[$x]['B' . $i] = $row['qty'];
                $array[$x]['c' . $i] = number_format($row['price'], 2);
                $x++;
            }
            $i = $i++;
            $array[$x]['A' . $i] = 'Total';
            $array[$x]['B' . $i] = $t_total_qty;
            $array[$x]['c' . $i] = 'NPR ' . number_format($t_total_amount, 2);
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_cart_abandon_csv()
    {
        $data = CheckoutStatus::select('checkout_status.customer_id as customer_id', 'customers.name', 'customers.email', 'customers.phone', 'customers.uuid as customer_uuid', DB::raw('COUNT(customer_id) as count'))
            ->join('customers', 'customers.id', '=', 'customer_id')
            ->whereDate('date', '<', date('Y-m-d'))
            ->groupBy('customer_id', 'customers.name', 'customers.email', 'customers.phone', 'customer_uuid')
            ->orderBy('date', 'ASC')->get()->keyBy('customer_uuid');
        
        $array_column_heading_names = [
            'A1' => 'Customer Name',
            'B1' => 'Customer Email',
            'C1' => 'Customer Phone',
            'D1' => 'Cart Abandon Count',
            'E1' => 'Date',
            'F1' => 'Product / Gift Voucher with Qty',
        ];
        $array = [];
        $item = [];
        if ($data) {
            $i = 2; 
            foreach ($data as $key => $row) {
                $array[$key]['A' . $i] = $row->name;
                $array[$key]['B' . $i] = $row->email;
                $array[$key]['C' . $i] = $row->phone;
                $array[$key]['D' . $i] = $row->count;
                $details = ReportService::_cart_abandon_details($row->customer_id);
                foreach($details['result'] as $d_row) {
                    $array[$key]['E' . $i] = $d_row['date'];
                    foreach($d_row['details'] as $r_row) {
                        $item[] = $r_row['name'] . '('. $r_row['qty'] .')';
                    }
                    $array[$key]['F' . $i] = implode(",",$item);
                    $i++;
                }
            }   
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_wishlist_csv()
    {
        $p_wishlists = Wishlist::select('wishlists.product_uuid as product_uuid', 'products.name as product_name')
            ->selectRaw('count(product_uuid) as count')
            ->join('products', 'products.uuid', '=', 'wishlists.product_uuid')
            ->groupBy('product_uuid', 'product_name')
            ->get();

        $g_wishlists = Wishlist::select('wishlists.gift_voucher_uuid as gift_voucher_uuid', 'gift_vouchers.name as gift_voucher_name')
            ->selectRaw('count(gift_voucher_uuid) as count')
            ->join('gift_vouchers', 'gift_vouchers.uuid', '=', 'wishlists.gift_voucher_uuid')
            ->groupBy('gift_voucher_uuid', 'gift_voucher_name')
            ->get();
        $data = [];
        foreach ($p_wishlists as $key => $row) {
            $data['product'][$key]['name'] = $row->product_name;
            $data['product'][$key]['count'] = $row->count;
            $wishlist_customers = Wishlist::with('customer')->where('product_uuid', $row->product_uuid)->get();
            foreach ($wishlist_customers as $index => $item) {
                $data['product'][$key]['customer'][$index]['date'] = date('Y-m-d', strtotime($item->created_at));
                $data['product'][$key]['customer'][$index]['name'] = $item->customer->name;
                $data['product'][$key]['customer'][$index]['email'] = $item->customer->email;
                $data['product'][$key]['customer'][$index]['phone'] = $item->customer->phone;
            }
        }
        foreach ($g_wishlists as $key => $row) {
            $data['gift'][$key]['name'] = $row->gift_voucher_name;
            $data['gift'][$key]['count'] = $row->count;
            $wishlist_customers = Wishlist::with('customer')->where('gift_voucher_uuid', $row->gift_voucher_uuid)->get();
            foreach ($wishlist_customers as $index => $item) {
                $data['gift'][$key]['customer'][$index]['date'] = date('Y-m-d', strtotime($item->created_at));
                $data['gift'][$key]['customer'][$index]['name'] = $item->customer->name;
                $data['gift'][$key]['customer'][$index]['email'] = $item->customer->email;
                $data['gift'][$key]['customer'][$index]['phone'] = $item->customer->phone;
            }
        }
        $array_column_heading_names = [
            'A1' => 'Name',
            'B1' => 'Type',
            'C1' => 'Count',
            'D1' => 'Date',
            'E1' => 'Customer Name',
            'F1' => 'Customer Email',
            'G1' => 'Customer Phone',
        ];
        $array = [];
        if ($data) {
            $i = 2; // always start this from 1
            foreach ($data as $type => $trow) {
                foreach($trow as $key => $row){
                    $array[$key]['A' . $i] = $row['name'];
                    $array[$key]['B' . $i] = ($type == 'product') ? 'Product' : 'Gift Voucher';
                    $array[$key]['C' . $i] = $row['count'];
                    foreach ($row['customer'] as $index => $item) {
                        $array[$key]['D' . $i] = $item['date'];
                        $array[$key]['E' . $i] = $item['name'];
                        $array[$key]['F' . $i] = $item['email'];
                        $array[$key]['G' . $i] = $item['phone'];
                        $i++;
                    }
                }
            }
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _format_for_cart_csv()
    {
        $p_carts = Cart::select('carts.product_uuid as product_uuid', 'products.name as product_name')
            ->selectRaw('sum(qty) as count')
            ->join('products', 'products.uuid', '=', 'carts.product_uuid')
            ->groupBy('product_uuid', 'product_name')
            ->get();

        $g_carts = Cart::select('carts.gift_voucher_uuid as gift_voucher_uuid', 'gift_vouchers.title as gift_voucher_name')
            ->selectRaw('sum(qty) as count')
            ->join('gift_vouchers', 'gift_vouchers.uuid', '=', 'carts.gift_voucher_uuid')
            ->groupBy('gift_voucher_uuid', 'gift_voucher_name')
            ->get();
        $data = [];
        foreach ($p_carts as $key => $row) {
            $data['product'][$key]['name'] = $row->product_name;
            $data['product'][$key]['count'] = $row->count;
            $cart_customers = Cart::with('customer', 'product', 'variation')->where('product_uuid', $row->product_uuid)->get();
            foreach ($cart_customers as $index => $item) {
                $data['product'][$key]['customer'][$index]['date'] = date('Y-m-d', strtotime($item->created_at));
                $data['product'][$key]['customer'][$index]['sku'] = $item->product_sku;
                $data['product'][$key]['customer'][$index]['variation'] = $item->variation->variant ?? '-';
                $data['product'][$key]['customer'][$index]['count'] = $item->qty;
                $data['product'][$key]['customer'][$index]['name'] = $item->customer->name;
                $data['product'][$key]['customer'][$index]['email'] = $item->customer->email;
                $data['product'][$key]['customer'][$index]['phone'] = $item->customer->phone;
            }
        }
        foreach ($g_carts as $key => $row) {
            $data['gift'][$key]['name'] = $row->gift_voucher_name;
            $data['gift'][$key]['count'] = $row->count;
            $cart_customers = Cart::with('customer', 'gift_voucher')->where('gift_voucher_uuid', $row->gift_voucher_uuid)->get();
            foreach ($cart_customers as $index => $item) {
                $data['gift'][$key]['customer'][$index]['date'] = date('Y-m-d', strtotime($item->created_at));
                $data['gift'][$key]['customer'][$index]['sku'] = '-';
                $data['gift'][$key]['customer'][$index]['variation'] = '-';
                $data['gift'][$key]['customer'][$index]['count'] = $item->qty;
                $data['gift'][$key]['customer'][$index]['name'] = $item->customer->name;
                $data['gift'][$key]['customer'][$index]['email'] = $item->customer->email;
                $data['gift'][$key]['customer'][$index]['phone'] = $item->customer->phone;
            }
        }
        $array_column_heading_names = [
            'A1' => 'Name',
            'B1' => 'Type',
            'C1' => 'Total Count',
            'D1' => 'Date',
            'E1' => 'Product SKU',
            'F1' => 'Variation',
            'G1' => 'Count',
            'H1' => 'Customer Name',
            'I1' => 'Customer Email',
            'J1' => 'Customer Phone',
        ];
        $array = [];
        if ($data) {
            $i = 2; // always start this from 1
            foreach ($data as $type => $trow) {
                foreach($trow as $key => $row){
                    $array[$key]['A' . $i] = $row['name'];
                    $array[$key]['B' . $i] = ($type == 'product') ? 'Product' : 'Gift Voucher';
                    $array[$key]['C' . $i] = $row['count'];
                    foreach ($row['customer'] as $index => $item) {
                        $array[$key]['D' . $i] = $item['date'];
                        $array[$key]['E' . $i] = $item['sku'];
                        $array[$key]['F' . $i] = $item['variation'];
                        $array[$key]['G' . $i] = $item['count'];
                        $array[$key]['H' . $i] = $item['name'];
                        $array[$key]['I' . $i] = $item['email'];
                        $array[$key]['J' . $i] = $item['phone'];
                        $i++;
                    }
                }
            }
        }

        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }
}
