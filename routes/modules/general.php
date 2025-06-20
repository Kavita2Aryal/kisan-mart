<?php

use App\Http\Controllers\General\DashController;
use App\Http\Controllers\General\LogController;
use App\Http\Controllers\General\SettingController;
use App\Http\Controllers\General\UserController;
use App\Http\Controllers\General\RoleController;
use App\Http\Controllers\General\ImageCacheController;

Route::get('/', [DashController::class, 'welcome'])->prefix('admin')->name('welcome');

$ctr = ImageCacheController::class;
Route::get('/image-cache/{path}', [$ctr, 'render'])->where('path', '.*');
Route::get('/section-cache/{path}', [$ctr, 'render_section'])->where('path', '.*');
Route::get('/ecommerce-cache/{path}', [$ctr, 'render_ecommerce'])->where('path', '.*');
Route::get('/product-cache/{path}', [$ctr, 'render_product'])->where('path', '.*');

Route::middleware(['auth', 'no.lockscreen'])->group(function () {

    $ctr = DashController::class;
    Route::get('/dashboard', [$ctr, 'index'])->name('dash.index');
    Route::get('/refresh', [$ctr, 'refresh'])->name('dash.refresh');
    Route::get('/help', [$ctr, 'help'])->name('dash.help');
    Route::get('/clear-cache', [$ctr, 'cache_clear'])->name('cache.clear')->middleware('can:cache.clear');
    Route::get('/monthly_sales', [$ctr, 'monthly_sales'])->name('get.monthly.sales');
    Route::get('/daily_sales', [$ctr, 'daily_sales'])->name('get.daily.sales');
    Route::get('/bounce_rate', [$ctr, 'bounce_rate'])->name('get.bounce.rate');
    Route::get('/order_by_day', [$ctr, 'order_by_day'])->name('get.order.by.day');
    Route::get('/users_by_country', [$ctr, 'users_by_country'])->name('get.users.by.country');

    $ctr = LogController::class;
    Route::get('/logs/all', [$ctr, 'activity_logs'])->name('log.activity')->middleware('can:activity.log');
    Route::get('/logs/me', [$ctr, 'my_logs'])->name('log.me');

    Route::get('/logs', [LogController::class, 'index'])->name('log.index')->middleware('can:activity.log');

    $ctr = SettingController::class;
    Route::get('/setting', [$ctr, 'index'])->name('setting.index');
    Route::post('/setting/update', [$ctr, 'update'])->name('setting.update')->middleware('can:setting.update');
    Route::put('/setting/{slug}/update-value', [$ctr, 'update_value'])->name('setting.update.value')->middleware('can:setting.update');
    Route::put('/setting/{slug}/update-status', [$ctr, 'update_status'])->name('setting.update.status')->middleware('can:setting.update');
    


    Route::prefix('user')->name('user.')->group(function () use ($ctr) {

        $ctr = UserController::class;
        Route::get('/', [$ctr, 'index'])->name('index')->middleware('can:user.view');
        Route::get('/create', [$ctr, 'create'])->name('create')->middleware('can:user.create');
        Route::post('/store', [$ctr, 'store'])->name('store')->middleware('can:user.create');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit')->middleware('can:user.update');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update')->middleware('can:user.update');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status')->middleware('can:user.update');
        Route::put('/{uuid}/view-permission', [$ctr, 'view_permission'])->name('view.permission')->middleware('can:user.view');
    });

    Route::middleware('can:user.role.all')->prefix('role')->name('role.')->group(function () {

        $ctr = RoleController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::post('/permissions', [$ctr, 'permissions'])->name('permissions');
    });
});
