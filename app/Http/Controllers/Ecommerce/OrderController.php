<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\Ecommerce\Order\CancelOrderDetail;
use App\Models\Ecommerce\OrderBillingAddress;
use App\Models\Ecommerce\OrderShippingAddress;
use App\Models\Ecommerce\Product\Product;
use App\Services\Ecommerce\BrandService;
use App\Services\Ecommerce\CategoryService;
use App\Services\Ecommerce\CustomerService;
use App\Services\Ecommerce\Order\OrderDetailService;
use App\Services\Ecommerce\Order\OrderPaymentLinkService;
use App\Services\Ecommerce\Order\OrderService;
use App\Services\General\ExportService;
use Session;

class OrderController extends Controller
{
    public function pending(Request $request)
    {
        $orders = OrderService::_paging($request, 'pending');
        return view('modules.ecommerce.order.pending', compact('orders'));
    }

    public function confirmed(Request $request)
    {
        $orders = OrderService::_paging($request, 'confirmed');
        return view('modules.ecommerce.order.confirmed', compact('orders'));
    }

    public function shipped(Request $request)
    {
        $orders = OrderService::_paging($request, 'shipped');
        return view('modules.ecommerce.order.shipped', compact('orders'));
    }

    public function delivered(Request $request)
    {
        $orders = OrderService::_paging($request, 'delivered');
        return view('modules.ecommerce.order.delivered', compact('orders'));
    }

    public function cancelled(Request $request)
    {
        $orders = OrderService::_paging($request, 'cancelled');
        return view('modules.ecommerce.order.cancelled', compact('orders'));
    }

    public function refund(Request $request)
    {
        $orders = OrderService::_paging($request, 'refund');
        return view('modules.ecommerce.order.refund', compact('orders'));
    }

    //modal
    public function getDetail(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->code) && $request->code != null) {
                $data                   = Order::with('customer')->where(['order_code' => $request->code])->first();
                $data_details           = OrderDetail::with('product')->with('variation')->where(['order_id' => $data->id])->get();
                $data_billing_address   = OrderBillingAddress::with('getArea')->with('getCity')->with('getRegion')->with('getCountry')->where(['order_id' => $data->id])->first();
                $data_shipping_address  = OrderShippingAddress::with('getArea')->with('getCity')->with('getRegion')->with('getCountry')->where(['order_id' => $data->id])->first();
                $order_status           = get_list_group('order-status');
                $currency               = $data->exchange_rate_id > 0 ? $data->exchangeRate->currency->currency : 'NPR';
                $rate                   = $data->exchange_rate_id > 0 ? $data->exchangeRate->rate : 1;
                $cancel_order_details   = count($data->cancelled_order_details);
                return response()->json([
                    'status' => true,
                    'data' => $data,
                    'currency' => $currency,
                    'data_details' => $data_details,
                    'cancel_order_details' => $cancel_order_details,
                    'data_billing_address' => $data_billing_address,
                    'data_shipping_address' => $data_shipping_address,
                    'order_status' => $order_status,
                    'currency' => $currency,
                    'rate' => $rate
                ]);
            }

            return response()->json(['status' => false]);
        }
        abort(404);
    }

    public function order_detail(Request $request, $uuid)
    {
        if ($data = OrderService::_order_detail($uuid)) {
            $order                      = $data['order'];
            $product_details            = $data['product_details'];
            $gift_voucher_details       = $data['gift_voucher_details'];
            $order_billing_address      = $data['order_billing_address'];
            $order_shipping_address     = $data['order_shipping_address'];
            $order_status               = get_list_group('order-status');
            $gift_voucher_options       = get_list_group('gift-voucher-option');
            $categories = CategoryService::_get();
            $brands = BrandService::_get();
            return view('modules.ecommerce.order.detail', compact('order', 'product_details', 'gift_voucher_details', 'order_billing_address', 'order_shipping_address', 'order_status', 'gift_voucher_options', 'categories', 'brands'));
        }
    }

    public function getCancelOrderDetail(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->code) && $request->code != null) {
                $data                   = Order::with('customer')->where(['order_code' => $request->code])->first();
                $data_details           = CancelOrderDetail::with('product')->where(['order_id' => $data->id])->get();
                $html = view('modules.ecommerce.order.includes.cancelled-items-modal', compact('data', 'data_details'))->render();
                return response()->json([
                    'status' => true,
                    'html' => $html
                ]);
            }

            return response()->json(['status' => false]);
        }
        abort(404);
    }

    public function confirmOrder(Request $request)
    {
        if ($request->ajax()) {
            if (OrderService::_confirm_order($request)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Order has been confirmed',
                    'url'   => route('order.confirmed')
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Sorry, could not change the status of the order to confirmed at this time. Please try again later.',
                'url'   => redirect()->back()
            ]);
        }
        abort(404);
    }

    public function shipOrder(Request $request)
    {
        if ($request->ajax()) {
            if (OrderService::_ship_order($request)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Order has been shipped',
                    'url'   => route('order.shipped')
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Sorry, could not change the status of the order to shipped at this time. Please try again later.',
                'url'   => redirect()->back()
            ]);
        }
        abort(404);
    }

    public function deliverOrder(Request $request)
    {
        if ($request->ajax()) {
            if (OrderService::_deliver_order($request)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Order has been delivered',
                    'url'   => route('order.delivered')
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Sorry, could not change the status of the order to delivered at this time. Please try again later.',
                'url'   => redirect()->back()
            ]);
        }
        abort(404);
    }

    public function cancelOrder(Request $request)
    {
        if ($request->ajax()) {
            if (OrderService::_cancel_order($request)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Order has been cancelled',
                    'url'   => route('order.cancelled')
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Sorry, could not change the status of the order to cancelled at this time. Please try again later.',
                'url'   => redirect()->back()
            ]);
        }

        abort(404);
    }

    public function refundOrder(Request $request)
    {
        if ($request->ajax()) {
            if (OrderService::_refund_order($request)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Order has been refunded',
                    'url'   => route('order.refund')
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Sorry, could not change the status of the order to refunded at this time. Please try again later.',
                'url'   => redirect()->back()
            ]);
        }

        abort(404);
    }

    public function compiled(Request $request)
    {
        $orders = Order::select('orders.id')
            ->Join('order_status', function ($join) {
                $join->on('orders.id', '=', 'order_status.order_id');
                $join->where('order_status.status', '=', config('app.custom.order_status_save.confirmed'));
                $join->where('order_status.is_active', '=', 10);
            })
            ->get()
            ->toArray();
        $order_ids = $orders != null ? array_column($orders, 'id') : [];
        $data = OrderDetail::select(DB::raw("SUM(order_details.qty) as total_qty"), 'products.unit', 'products.name', 'products.id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->whereIn('order_id', $order_ids)
            ->groupBy('products.id', 'products.name', 'products.unit')
            ->get();

        return view('modules.ecommerce.order.compiled', compact('data'));
    }

    public function removeDetail(Request $request)
    {
        if ($request->ajax()) {
            $return = OrderDetailService::_remove_order_detail($request);
            return response()->json($return);
        }
        abort(404);
    }

    public function updateDetail(Request $request)
    {
        if ($request->ajax()) {
            $return = OrderDetailService::_update_order_detail($request);
            return response()->json($return);
        }
        abort(404);
    }

    public function addItems(Request $request, $uuid)
    {
        $order = OrderService::_get_details($uuid);
        $categories = CategoryService::_get();
        $brands = BrandService::_get();
        $data = [];
        if ($request->has('products')) {
            $data = OrderService::_confirm_items($request->products, $uuid);
        }
        return view('modules.ecommerce.order.add-items', compact('order', 'categories', 'brands', 'data'));
    }

    public function saveItems(Request $request, $uuid)
    {
        if ($request->has('products')) {
            $data = OrderDetailService::_save_order_detail($request->products, $uuid);
        }
        return redirect()->route('order.detail', [$uuid])->with('success', 'New Items has been added to this order');
    }

    public function export_csv()
    {        
        $orders = OrderService::_get();
        $orders = OrderService::_format_for_csv($orders);
        return ExportService::csv($orders, 'orders');
    }

    public function export_pdf($uuid)
    {
        $order = OrderService::_get_details($uuid);
        return ExportService::pdf($order, $order->order_code . '-order-details', 'order-detail');
    }
}
