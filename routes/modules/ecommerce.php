<?php

use App\Http\Controllers\Ecommerce\AreaController;
use App\Http\Controllers\Ecommerce\BrandController;
use App\Http\Controllers\Ecommerce\CategoryController;
use App\Http\Controllers\Ecommerce\CityController;
use App\Http\Controllers\Ecommerce\CollectionController;
use App\Http\Controllers\Ecommerce\OfferController;
use App\Http\Controllers\Ecommerce\ColorController;
use App\Http\Controllers\Ecommerce\ColorGroupController;
use App\Http\Controllers\Ecommerce\ComboProductController;
use App\Http\Controllers\Ecommerce\CountryController;
use App\Http\Controllers\Ecommerce\CurrencyController;
use App\Http\Controllers\Ecommerce\CustomerController;
use App\Http\Controllers\Ecommerce\EcommerceSettingController;
use App\Http\Controllers\Ecommerce\DeliveryController;
use App\Http\Controllers\Ecommerce\GiftVoucherController;
use App\Http\Controllers\Ecommerce\ImageUploadController;
use App\Http\Controllers\Ecommerce\OrderController;
use App\Http\Controllers\Ecommerce\OrderCreateController;
use App\Http\Controllers\Ecommerce\PolicyController;
use App\Http\Controllers\Ecommerce\ProductController;
use App\Http\Controllers\Ecommerce\ProductQuestionAnswerController;
use App\Http\Controllers\Ecommerce\ProductReviewController;
use App\Http\Controllers\Ecommerce\PromoCodeController;
use App\Http\Controllers\Ecommerce\RegionController;
use App\Http\Controllers\Ecommerce\ReportController;
use App\Http\Controllers\Ecommerce\SizeController;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('cache-clear', function () {
        Artisan::call('optimize:clear');
    });
    Route::get('cache-set', function () {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
    });

    Route::get('/ecommerce/setting', [EcommerceSettingController::class, 'index'])->name('ecommerce.setting.index');

    Route::middleware('can:customer.all')->prefix('customer')->name('customer.')->group(function () {
        $ctr = CustomerController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::get('/export/csv', [$ctr, 'export_csv'])->name('export.csv');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/search', [$ctr, 'search'])->name('search');
        Route::get('/{uuid}/order', [$ctr, 'order'])->name('order');
        Route::get('/order/detail', [$ctr, 'order_detail'])->name('order.detail');
    });

    Route::middleware('can:country.all')->prefix('country')->name('country.')->group(function () {

        $ctr = CountryController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });
    Route::middleware('can:region.all')->prefix('region')->name('region.')->group(function () {

        $ctr = RegionController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });
    Route::middleware('can:city.all')->prefix('city')->name('city.')->group(function () {

        $ctr = CityController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });



    Route::middleware('can:delivery.all')->prefix('delivery')->name('delivery.')->group(function () {

        $ctr = DeliveryController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');





    });



    Route::middleware('can:area.all')->prefix('area')->name('area.')->group(function () {

        $ctr = AreaController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });

    Route::middleware('can:category.all')->prefix('category')->name('category.')->group(function () {

        $ctr = CategoryController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::put('/{uuid}/check', [$ctr, 'check'])->name('check');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/{uuid}/search', [$ctr, 'search'])->name('search');
    });

    Route::middleware('can:color.all')->prefix('color')->name('color.')->group(function () {

        $ctr = ColorController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/search', [$ctr, 'search'])->name('search');
    });

    Route::middleware('can:color.all')->prefix('color/group')->name('color.group.')->group(function () {

        $ctr = ColorGroupController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/search', [$ctr, 'search'])->name('search');
    });

    Route::middleware('can:size.all')->prefix('size')->name('size.')->group(function () {

        $ctr = SizeController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/search', [$ctr, 'search'])->name('search');
    });

    Route::middleware('can:brand.all')->prefix('brand')->name('brand.')->group(function () {

        $ctr = BrandController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });

    Route::middleware('can:collection.all')->prefix('collection')->name('collection.')->group(function () {

        $ctr = CollectionController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/{uuid}/manage', [$ctr, 'manage'])->name('manage');
        Route::put('/{uuid}/manage-save', [$ctr, 'manage_save'])->name('manage.save');
        Route::put('/{uuid}/remove-products', [$ctr, 'remove_products'])->name('remove.products');
    });

    Route::middleware('can:offer.all')->prefix('offer')->name('offer.')->group(function () {

        $ctr = OfferController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/{uuid}/manage', [$ctr, 'manage'])->name('manage');
        Route::put('/{uuid}/manage-save', [$ctr, 'manage_save'])->name('manage.save');
        Route::put('/{uuid}/remove-products', [$ctr, 'remove_products'])->name('remove.products');
        Route::put('/{uuid}/discount-update', [$ctr, 'discount_update'])->name('discount.update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
    });

    Route::middleware('can:promocode.all')->prefix('promocode')->name('promocode.')->group(function () {

        $ctr = PromoCodeController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/{uuid}/manage', [$ctr, 'manage'])->name('manage');
        Route::put('/{uuid}/manage-save', [$ctr, 'manage_save'])->name('manage.save');
        Route::put('/{uuid}/remove-products', [$ctr, 'remove_products'])->name('remove.products');
    });

    Route::middleware('can:product.all')->prefix('product')->name('product.')->group(function () {

        $ctr = ProductController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::put('/{uuid}/check', [$ctr, 'check'])->name('check');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::put('/{uuid}/change-stock-status', [$ctr, 'change_stock_status'])->name('change.stock.status');
        Route::post('/get-details', [$ctr, 'get_details'])->name('get.details');
        Route::post('/{uuid}/quick/update', [$ctr, 'quick_update'])->name('quick.update');
        Route::get('/import', [$ctr, 'import'])->name('import');
        Route::post('/excel.upload', [$ctr, 'excel_upload'])->name('excel.upload');
        Route::post('/excel.remove', [$ctr, 'excel_remove'])->name('excel.remove');
        Route::get('search', [$ctr, 'search'])->name('search');

        Route::get('/export/csv', [$ctr, 'export_csv'])->name('export.csv');
    });

    Route::middleware('can:combo.product.all')->prefix('combo/product')->name('combo.product.')->group(function () {

        $ctr = ComboProductController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::put('/{uuid}/check', [$ctr, 'check'])->name('check');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::post('/get-details', [$ctr, 'get_details'])->name('get.details');
        Route::post('/{uuid}/quick/update', [$ctr, 'quick_update'])->name('quick.update');
        Route::get('/import', [$ctr, 'import'])->name('import');
        Route::post('/excel.upload', [$ctr, 'excel_upload'])->name('excel.upload');
        Route::post('/excel.remove', [$ctr, 'excel_remove'])->name('excel.remove');
        Route::get('search', [$ctr, 'search'])->name('search');
        Route::get('autosearch', [$ctr, 'autosearch'])->name('autosearch');

        Route::get('/export/csv', [$ctr, 'export_csv'])->name('export.csv');
    });

    Route::middleware('can:gift.voucher.all')->prefix('gift/voucher')->name('gift.voucher.')->group(function () {

        $ctr = GiftVoucherController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::put('/{uuid}/check', [$ctr, 'check'])->name('check');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });

    Route::middleware('can:order.all')->prefix('order')->name('order.')->group(function () {

        $ctr = OrderController::class;
        Route::get('/pending', [$ctr, 'pending'])->name('pending');
        Route::get('/confirmed', [$ctr, 'confirmed'])->name('confirmed');
        Route::get('/shipped', [$ctr, 'shipped'])->name('shipped');
        Route::get('/delivered', [$ctr, 'delivered'])->name('delivered');
        Route::get('/cancelled', [$ctr, 'cancelled'])->name('cancelled');
        Route::get('/refund', [$ctr, 'refund'])->name('refund');
        Route::get('/compiled', [$ctr, 'compiled'])->name('compiled');
        Route::get('{uuid}/detail', [$ctr, 'order_detail'])->name('detail');

        Route::post('/get-detail', [$ctr, 'getDetail'])->name('get.detail');
        Route::post('/get-cancel-detail', [$ctr, 'getCancelOrderDetail'])->name('cancelled.get.detail');
        Route::post('/confirm', [$ctr, 'confirmOrder'])->name('confirm.save');
        Route::post('/ship', [$ctr, 'shipOrder'])->name('ship.save');
        Route::post('/deliver', [$ctr, 'deliverOrder'])->name('deliver.save');
        Route::post('/refund', [$ctr, 'refundOrder'])->name('refund.save');
        Route::post('/cancel', [$ctr, 'cancelOrder'])->name('cancel.save');

        Route::get('/export/csv', [$ctr, 'export_csv'])->name('export.csv');
        Route::get('/export/pdf/{uuid}', [$ctr, 'export_pdf'])->name('export.pdf');

        Route::post('/payment/save', [$ctr, 'payment_save'])->name('payment.save');

        /* order detail edit and update*/
        Route::post('/detail/remove', [$ctr, 'removeDetail'])->name('detail.remove');
        Route::post('/detail/update', [$ctr, 'updateDetail'])->name('detail.update');
        Route::get('/add/items/{uuid}', [$ctr, 'addItems'])->name('add.items');
        Route::post('/add/items/{uuid}', [$ctr, 'addItems'])->name('add.items');
        Route::post('/save/items/{uuid}', [$ctr, 'saveItems'])->name('save.items');
        /* order detail edit and update*/

        /* order create*/
        $ctr = OrderCreateController::class;
        Route::get('/select/items', [$ctr, 'selectItems'])->name('select.items');
        Route::post('/save/selected/items', [$ctr, 'saveSelectedItems'])->name('save.selected.items');
        Route::put('/remove/selected/items', [$ctr, 'removeSelectedItems'])->name('remove.selected.items');
        Route::put('/update/selected/items', [$ctr, 'updateSelectedItems'])->name('update.selected.items');
        Route::post('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        /* order create*/

    });

    Route::middleware('can:currency.all')->prefix('currency')->name('currency.')->group(function () {

        $ctr = CurrencyController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::get('/{uuid}/exchange-rate', [$ctr, 'exchange_rate'])->name('exchange.rate.edit');
        Route::put('/{uuid}/exchange-rate', [$ctr, 'exchange_rate_update'])->name('exchange.rate.update');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });

    Route::post('/image/upload', [ImageUploadController::class, 'upload'])->name('image.upload');
    Route::post('/image/remove', [ImageUploadController::class, 'remove'])->name('image.remove');

    Route::middleware('can:report.all')->prefix('report')->name('report.')->group(function () {
        $ctr = ReportController::class;
        Route::get('/sales', [$ctr, 'sales'])->name('sales');
        Route::get('/best-seller', [$ctr, 'bestSeller'])->name('best-seller');
        Route::get('/vat-amount', [$ctr, 'vatReport'])->name('vat');
        Route::get('/product-category', [$ctr, 'productCategory'])->name('product-category');
        Route::get('/product-brand', [$ctr, 'productBrand'])->name('product-brand');
        Route::get('/most-searched-keyword', [$ctr, 'mostSearchedKeyword'])->name('most-searched-keyword');
        Route::get('/product-view', [$ctr, 'productView'])->name('product-view');
        Route::get('/cart', [$ctr, 'cart'])->name('cart');
        Route::get('/cart/customer', [$ctr, 'cartCustomer'])->name('cart.customer');
        Route::get('/wishlist', [$ctr, 'wishlist'])->name('wishlist');
        Route::get('/wishlist/customer', [$ctr, 'wishlistCustomer'])->name('wishlist.customer');
        Route::get('/cart-abandon', [$ctr, 'cartAbandon'])->name('cart.abandon');
        Route::get('/cart-abandon/{uuid}/{id}/details', [$ctr, 'cartAbandonDetails'])->name('cart.abandon.details');
        Route::get('/cash-on-delivery', [$ctr, 'cashOnDelivery'])->name('cash-on-delivery');

        Route::prefix('export/csv')->name('export.csv.')->group(function () use ($ctr) {
            Route::get('/sales', [$ctr, 'export_csv_sales'])->name('sales');
            Route::get('/best-seller', [$ctr, 'export_csv_best_seller'])->name('best-seller');
            Route::get('/vat-amount', [$ctr, 'export_csv_vat'])->name('vat');
            Route::get('/product-category', [$ctr, 'export_csv_product_category'])->name('product-category');
            Route::get('/product-brand', [$ctr, 'export_csv_product_brand'])->name('product-brand');
            Route::get('/most-searched-keyword', [$ctr, 'export_csv_most_searched_keyword'])->name('most-searched-keyword');
            Route::get('/product-view', [$ctr, 'export_csv_product_view'])->name('product-view');
            Route::get('/cart', [$ctr, 'export_csv_cart'])->name('cart');
            Route::get('/wishlist', [$ctr, 'export_csv_wishlist'])->name('wishlist');
            Route::get('/cart-abandon', [$ctr, 'export_csv_cart_abandon'])->name('cart.abandon');
        });
    });

    Route::middleware('can:product.review.all')->prefix('product/review')->name('product.review.')->group(function () {
        $ctr = ProductReviewController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/show/{uuid}', [$ctr, 'show'])->name('show');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
    });

    Route::middleware('can:product.question.answer.all')->prefix('product/question-answer')->name('product.question.answer.')->group(function () {

        $ctr = ProductQuestionAnswerController::class;
        Route::get('/pending', [$ctr, 'pending'])->name('pending');
        Route::get('/replied', [$ctr, 'replied'])->name('replied');
        Route::get('/get-detail', [$ctr, 'get_detail'])->name('get.detail');
        Route::post('/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });

    Route::middleware('can:policy.all')->prefix('policy')->name('policy.')->group(function () {

        $ctr = PolicyController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });
});
