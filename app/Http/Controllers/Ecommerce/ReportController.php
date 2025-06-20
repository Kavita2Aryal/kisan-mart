<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Services\Ecommerce\ReportCsvService;
use Illuminate\Http\Request;

use App\Services\Ecommerce\ReportService;
use App\Services\General\ExportService;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $result = ReportService::_sales($request);
        $data = $result['sales'];
        $all = $result['all'];
        // dd($all, $data);

        return view('modules.ecommerce.report.sales', compact('all', 'data'));
    }

    public function vatReport(Request $request)
    {
        $result = ReportService::_vat_report($request);
        $data = $result['vat'];
        $all = $result['all'];
        return view('modules.ecommerce.report.vat-report', compact('all', 'data'));
    }

    public function bestSeller(Request $request)
    {
        $result = ReportService::_best_seller($request);
        $data = $result['best_seller_data'];
        $all = $result['all'];
        return view('modules.ecommerce.report.best-seller', compact('all', 'data'));
    }

    public function productCategory(Request $request)
    {
        $result = ReportService::_product_category($request);
        $data = $result['product_category'];
        $all = $result['all'];
        return view('modules.ecommerce.report.product-category', compact('all', 'data'));
    }

    public function productBrand(Request $request)
    {
        $result = ReportService::_product_brand($request);
        $data = $result['product_brand'];
        $all = $result['all'];
        return view('modules.ecommerce.report.product-brand', compact('all', 'data'));
    }

    public function mostSearchedKeyword(Request $request)
    {
        $data = ReportService::_most_searched_keyword($request);
        return view('modules.ecommerce.report.most-searched-keyword', compact('data'));
    }

    public function productView(Request $request)
    {
        $result = ReportService::_product_view($request);
        $data = $result['products'];
        $url = $result['url'];
        $current_page = $result['current_page'];
        return view('modules.ecommerce.report.product-view', compact('data', 'url', 'current_page'));
    }

    public function cart(Request $request)
    {
        $carts = ReportService::_cart_report($request);
        return view('modules.ecommerce.report.cart', compact('carts'));
    }

    public function wishlist(Request $request)
    {
        $wishlists = ReportService::_wishlist_report($request);
        return view('modules.ecommerce.report.wishlist', compact('wishlists'));
    }

    public function cartAbandon(Request $request)
    {
        $cart_abandons = ReportService::_cart_abandon_report($request);
        return view('modules.ecommerce.report.cart-abandon', compact('cart_abandons'));
    }

    public function cartAbandonDetails(Request $request, $uuid, $id)
    {
        $result = ReportService::_cart_abandon_details($id);
        $data = $result['result'];
        $customer = $result['customer'];
        return view('modules.ecommerce.report.cart-abandon-details', compact('data', 'customer'));
    }

    public function wishlistCustomer(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $data = ReportService::_wishlist_customer($request);
        $html = view('modules.ecommerce.report.includes.wishlist-customer-modal', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }

    public function cartCustomer(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $data = ReportService::_cart_customer($request);
        $html = view('modules.ecommerce.report.includes.cart-customer-modal', compact('data'))->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }

    public function cashOnDelivery(Request $request)
    {
        $result = ReportService::_cash_on_delivery($request);
        $data = $result['cash_on_delivery'];
        $all = $result['all'];

        return view('modules.ecommerce.report.cash-on-delivery', compact('all', 'data'));
    }

    public function export_csv_sales(Request $request)
    {
        $data = ReportCsvService::_format_for_sales_csv();
        return ExportService::csv($data, 'sales-report');
    }

    public function export_csv_vat(Request $request)
    {
        $data = ReportCsvService::_format_for_vat_csv();
        return ExportService::csv($data, 'vat-report');
    }

    public function export_csv_best_seller(Request $request)
    {
        $data = ReportCsvService::_format_for_best_seller_csv();
        return ExportService::csv($data, 'best-seller-report');
    }

    public function export_csv_product_category(Request $request)
    {
        $data = ReportCsvService::_format_for_product_category_csv();
        return ExportService::csv($data, 'product-category-report');
    }

    public function export_csv_product_brand(Request $request)
    {
        $data = ReportCsvService::_format_for_product_brand_csv();
        return ExportService::csv($data, 'product-brand-report');
    }

    public function export_csv_most_searched_keyword(Request $request)
    {
        $data = ReportCsvService::_format_for_most_searched_keyword_csv();
        return ExportService::csv($data, 'most-searched-keyword-report');
    }

    public function export_csv_product_view(Request $request)
    {
        $data = ReportCsvService::_format_for_product_view_csv();
        return ExportService::csv($data, 'product-view-report');
    }

    public function export_csv_cart(Request $request)
    {
        $data = ReportCsvService::_format_for_cart_csv();
        return ExportService::csv($data, 'cart-report');
    }

    public function export_csv_wishlist(Request $request)
    {
        $data = ReportCsvService::_format_for_wishlist_csv();
        return ExportService::csv($data, 'wishlist-report');
    }

    public function export_csv_cart_abandon(Request $request)
    {
        $data = ReportCsvService::_format_for_cart_abandon_csv();
        return ExportService::csv($data, 'cart-abandon-report');
    }
}
