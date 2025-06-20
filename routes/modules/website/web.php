<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Addons\BlogController;
use App\Http\Controllers\Addons\ContactController;
use App\Http\Controllers\Addons\NewsletterController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Cms\PageController;
use App\Http\Controllers\Ecommerce\BrandController;
use App\Http\Controllers\Ecommerce\CustomerController;
use App\Http\Controllers\Ecommerce\CustomerBillingDetailController;
use App\Http\Controllers\Ecommerce\CustomerShippingDetailController;
use App\Http\Controllers\Ecommerce\WishlistController;
use App\Http\Controllers\Ecommerce\ProductController;
use App\Http\Controllers\Ecommerce\ProductReviewController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\CheckoutController;
use App\Http\Controllers\Ecommerce\CollectionController;
use App\Http\Controllers\Ecommerce\CurrencyController;
use App\Http\Controllers\Ecommerce\GiftVoucherController;
use App\Http\Controllers\Ecommerce\OrderTrackingController;
use App\Http\Controllers\Ecommerce\PromoCodeController;
use App\Http\Controllers\Ecommerce\SearchController;
use App\Http\Controllers\Ecommerce\PaymentController;
use App\Http\Controllers\Ecommerce\PolicyController;
use App\Http\Controllers\Ecommerce\ProductQuestionAnswerController;

Route::middleware(['auth', 'verified', 'no.maintenance'])->group(function ()  {
    Route::middleware('no.checkout.session')->group(function () {
        $ctr = CustomerController::class;
        Route::get('/dashboard', [$ctr, 'dashboard'])->name('dashboard');
        Route::get('/address', [$ctr, 'address'])->name('address');
        Route::get('/profile', [$ctr, 'index'])->name('profile');
        Route::get('/profile/edit', [$ctr, 'profile_edit'])->name('profile.edit');
        Route::post('/profile/update', [$ctr, 'profile_update'])->name('profile.update');
        Route::post('/profile/image/upload', [$ctr, 'profile_image_upload'])->name('profile.image.upload');
        Route::post('/profile/image/remove', [$ctr, 'profile_image_remove'])->name('profile.image.remove');
        Route::get('/order/detail/{uuid}', [$ctr, 'getOrderDetail'])->name('order.detail');
        Route::get('/get-product', [$ctr, 'getProduct'])->name('get.product');
        Route::get('/order/history', [$ctr, 'order_history'])->name('order.history');

        Route::prefix('product/review')->name('product.review.')->group(function () {

            $ctr = ProductReviewController::class;
            Route::get('/', [$ctr, 'index'])->name('index');
            Route::get('/store/{uuid}/{order_uuid}', [$ctr, 'product_review_store'])->name('store');
            Route::post('/post', [$ctr, 'save'])->name('post');
            Route::get('/history', [$ctr, 'product_review_history'])->name('history');
        });

        Route::prefix('product/question-answer')->name('product.question.answer.')->group(function () {

            $ctr = ProductQuestionAnswerController::class;
            Route::post('/store/{uuid}', [$ctr, 'save'])->name('save');
        });

        Route::prefix('password')->name('password.')->group(function () {

            $ctr = ChangePasswordController::class;
            Route::get('/change', [$ctr, 'showChangePasswordForm'])->name('change');
            Route::get('/set', [$ctr, 'showSetPasswordForm'])->name('set');
            Route::put('/store', [$ctr, 'storePassword'])->name('store');
            Route::put('/update', [$ctr, 'updatePassword'])->name('update');
        });

        Route::prefix('billing-address')->group(function () {

            $ctr = CustomerBillingDetailController::class;
            Route::get('/', [$ctr, 'index'])->name('billing.address');
            Route::post('/get', [$ctr, 'get'])->name('billing.address.get');
            Route::post('/save', [$ctr, 'save'])->name('billing.address.save');
        });

        Route::prefix('shipping-address')->group(function () {

            $ctr = CustomerShippingDetailController::class;
            Route::get('/', [$ctr, 'index'])->name('shipping.address');
            Route::post('/get', [$ctr, 'get'])->name('shipping.address.get');
            Route::post('/save', [$ctr, 'save'])->name('shipping.address.save');
        });

        Route::name('cart.')->prefix('cart')->group(function () {
            $ctr = CartController::class;
            Route::get('/', [$ctr, 'index'])->name('index');
            Route::post('/addup', [$ctr, 'addup'])->name('addup');
            Route::post('/update', [$ctr, 'update'])->name('update');
            Route::post('/remove', [$ctr, 'remove'])->name('remove');
            Route::get('/remove-all', [$ctr, 'removeAll'])->name('remove.all');
            Route::delete('/destroy', [$ctr, 'destroy'])->name('destroy');
        });

        Route::post('/policy-agreed', [CustomerController::class, 'policy_agreed'])->name('policy.agreed');

        Route::name('wishlist.')->prefix('wishlist')->group(function () {
            $ctr = WishlistController::class;
            Route::get('/', [$ctr, 'index'])->name('index');
            Route::post('/update', [$ctr, 'update'])->name('update');
            Route::post('/remove', [$ctr, 'remove'])->name('remove');
            Route::get('/remove-all', [$ctr, 'removeAll'])->name('remove.all');
            Route::delete('/destroy', [$ctr, 'destroy'])->name('destroy');
        });
    });

    Route::post('apply-promo-code', [PromoCodeController::class, 'index'])->name('promo.code.apply');
    Route::post('apply-gift-voucher', [GiftVoucherController::class, 'apply'])->name('gift.voucher.apply');

    Route::name('checkout.')->prefix('checkout')->group(function () {
        $ctr = CheckoutController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::post('/submit', [$ctr, 'submit'])->name('submit');
        Route::get('/status', [$ctr, 'status'])->name('status');
        Route::post('/prepare-quick', [$ctr, 'prepareQuick'])->name('direct.prepare');
        Route::get('/quick', [$ctr, 'quick'])->name('direct');
        Route::post('/proceed-to-payment', [$ctr, 'proceedToPayment'])->name('proceed.to.payment');
        Route::get('get-delivery-charge/{area_id}/{day}/{sub_total}',[$ctr,'getDeliveryCharge'])->name('get.delivery.charge');
    });
    Route::name('payment.')->prefix('payment')->group(function () {
        $ctr = PaymentController::class;

        Route::get('/', [$ctr, 'index'])->name('index');
        Route::post('/submit', [$ctr, 'payment'])->name('submit');
        Route::get('fonepay/verify', [$ctr, 'fonepay_verify'])->name('fonepay.verify');
        Route::post('hbl/result', [$ctr, 'hbl_frontend'])->name('hbl.frontend');
        Route::post('hbl/response', [$ctr, 'hbl_backend'])->name('hbl.backend');
        Route::get('esewa/success', [$ctr, 'esewa_success'])->name('esewa.success');
        Route::get('esewa/failed', [$ctr, 'esewa_failed'])->name('esewa.failed');
    });
});

Route::middleware('no.maintenance')->group(function () {

    Route::post('/currency/preference', [CurrencyController::class, 'set_currency_preference'])->name('set.currency.preference');

    Route::middleware('no.checkout.session')->group(function () {

        Route::get('cache-clear', function () {
            Artisan::call('optimize:clear');
        });
        Route::get('cache-set', function () {
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');
        });

        /*
        |--------------------------------------------------------------------------
        | OTHER Route
        |--------------------------------------------------------------------------
        */

        Route::get('/', [PageController::class, 'index'])->name('home');
        Route::get('/preview', [PageController::class, 'preview'])->name('preview');
        Route::get('/terms-and-conditions', [PolicyController::class, 'index'])->name('terms.and.conditions');
        Route::get('/brands', [BrandController::class, 'index'])->name('brand');

        Route::get('/thank-you/{encrypt}', [ThankyouController::class, 'index'])->name('thankyou');
        Route::post('/hit-product', [ProductController::class, 'storeProductHitCount'])->name('hit.count.product');

        Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
        Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');

        Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/gift-voucher', [GiftVoucherController::class, 'index'])->name('gift.voucher.index');
        Route::get('/collections', [CollectionController::class, 'index'])->name('collection.index');
        Route::get('/promotions', [CollectionController::class, 'index'])->name('promotion.index');
        Route::get('/newarrivals', [CollectionController::class, 'index'])->name('newarrival.index');
        Route::get('/occasions', [CollectionController::class, 'index'])->name('occasion.index');
        Route::get('/search', [SearchController::class, 'show'])->name('search');

        Route::name('order.tracking.')->prefix('order/tracking')->group(function () {
            $ctr = OrderTrackingController::class;
            Route::get('/', [$ctr, 'index'])->name('index');
            Route::post('/submit', [$ctr, 'submit'])->name('submit');
            Route::get('/check', [$ctr, 'check'])->name('check');
            Route::get('/export/pdf/{uuid}', [$ctr, 'export_pdf'])->name('export.pdf');

        });
        /*
        |--------------------------------------------------------------------------
        | this routes should be always at the last
        |--------------------------------------------------------------------------
        */

        if (!app()->runningInConsole()) {
            $result = check_web_page_type(false);
            if ($result['status']) Route::get($result['uri'], [$result['class'], $result['action']])->name($result['route_name']);
        }
    });
});
