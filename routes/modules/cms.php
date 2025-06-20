<?php

use App\Http\Controllers\Cms\PageController;
use App\Http\Controllers\Cms\MenuController;
use App\Http\Controllers\Cms\MediaController;
use App\Http\Controllers\Cms\SliderController;
use App\Http\Controllers\Cms\PopupController;
use App\Http\Controllers\Cms\WebAliasController;

Route::middleware(['auth', 'no.lockscreen'])->prefix('admin')->group(function () {

    $ctr = PageController::class;
    Route::get('/page', [$ctr, 'index'])->name('page.index')->middleware('can:page.view');
    Route::delete('/page/{uuid}/destroy', [$ctr, 'destroy'])->name('page.destroy')->middleware('can:page.delete');
    Route::put('/page/section/check', [$ctr, 'check'])->name('page.section.check');
    Route::post('/page/generate-form', [$ctr, 'generate_form'])->name('page.generate.form');

    Route::middleware(['full.cms'])->group(function () {
        Route::middleware(['add.page', 'can:page.create'])->group(function () {
            $ctr = PageController::class;

            Route::get('/page/create', [$ctr, 'create'])->name('page.create');
            Route::post('/page/store', [$ctr, 'store'])->name('page.store');
            Route::get('/page/layout/create', [$ctr, 'create_layout'])->name('page.layout.create');
            Route::post('/page/layout/store', [$ctr, 'store_layout'])->name('page.layout.store');

            Route::post('/page/layout-config/store', [$ctr, 'store_layout_config'])->name('page.layout.config.store');
            Route::delete('/page/layout-config/{uuid}/destroy', [$ctr, 'destroy_layout_config'])->name('page.layout.config.destroy');
        });

        Route::middleware(['can:page.update'])->group(function () {
           
            $ctr = PageController::class;
            Route::get('/page/layout/{uuid}/edit', [$ctr, 'edit_layout'])->name('page.layout.edit');
            Route::put('/page/layout/{uuid}/update', [$ctr, 'update_layout'])->name('page.layout.update');
        });
    }); 
    
    Route::middleware(['mini.cms', 'add.page', 'can:page.create'])->group(function () {
        $ctr = PageController::class;

        Route::get('/page/add', [$ctr, 'create_mini'])->name('page.mini.create');
        Route::post('/page/adding', [$ctr, 'store_mini'])->name('page.mini.store');
    });

    Route::middleware(['can:page.update'])->group(function () {

        $ctr = PageController::class;
        Route::get('/page/{uuid}/edit', [$ctr, 'edit'])->name('page.edit');
        Route::put('/page/{uuid}/update', [$ctr, 'update'])->name('page.update');
        Route::put('/page/{uuid}/change-status', [$ctr, 'change_status'])->name('page.change.status');
        Route::put('/page/{uuid}/change-home', [$ctr, 'change_home'])->name('page.change.home');
        Route::put('/page/section/{uuid}/update', [$ctr, 'update_section'])->name('page.section.update');
    });


    Route::middleware('can:menu.update')->group(function () {

        $ctr = MenuController::class;
        Route::get('/menu/builder/desktop', [$ctr, 'desktop'])->name('menu.desktop');
        Route::get('/menu/builder/mobile', [$ctr, 'mobile'])->name('menu.mobile');
        Route::post('/menu/store', [$ctr, 'store'])->name('menu.store');
    });

    Route::middleware('can:media.all')->group(function () {

        $ctr = MediaController::class;

        Route::get('/media', [$ctr, 'index'])->name('media.index');
        Route::get('/media/upload', [$ctr, 'upload'])->name('media.upload');
        Route::post('/media/upload-image', [$ctr, 'upload_image'])->name('media.upload.image');
        Route::post('/media/upload-image-modal', [$ctr, 'upload_image_modal'])->name('media.upload.image.modal');
        Route::post('/media/remove-image', [$ctr, 'remove_image'])->name('media.remove.image');
        Route::post('/media/update-detail', [$ctr, 'update_detail'])->name('media.update.detail');
        Route::post('/media/crop-image', [$ctr, 'crop_image'])->name('media.crop.image');
        Route::post('/media/get-image', [$ctr, 'get_image'])->name('media.get.image');
    });

    Route::middleware('can:slider.all')->group(function () {

        $ctr = SliderController::class;
        Route::get('/slider', [$ctr, 'index'])->name('slider.index');
        Route::get('/slider/create', [$ctr, 'create'])->name('slider.create');
        Route::post('/slider/store', [$ctr, 'store'])->name('slider.store');
        Route::get('/slider/{uuid}/edit', [$ctr, 'edit'])->name('slider.edit');
        Route::put('/slider/{uuid}/update', [$ctr, 'update'])->name('slider.update');
        Route::delete('/slider/{uuid}/destroy', [$ctr, 'destroy'])->name('slider.destroy');
        Route::post('/slider/manage-order', [$ctr, 'manage_order'])->name('slider.manage.order');
        Route::get('/slider/{uuid}/sort', [$ctr, 'sort'])->name('slider.sort');
        Route::post('/slider/generate-form', [$ctr, 'generate_form'])->name('slider.generate.form');
        Route::get('/slider/get', [$ctr, 'get'])->name('slider.get');
    });

    Route::middleware('can:popup.all')->group(function () {

        $ctr = PopupController::class;
        Route::get('/popup', [$ctr, 'index'])->name('popup.index');
        Route::get('/popup/create', [$ctr, 'create'])->name('popup.create');
        Route::post('/popup/store', [$ctr, 'store'])->name('popup.store');
        Route::get('/popup/{uuid}/edit', [$ctr, 'edit'])->name('popup.edit');
        Route::put('/popup/{uuid}/update', [$ctr, 'update'])->name('popup.update');
        Route::delete('/popup/{uuid}/destroy', [$ctr, 'destroy'])->name('popup.destroy');
        Route::put('/popup/{uuid}/change-status', [$ctr, 'change_status'])->name('popup.change.status');
    });

    $ctr = WebAliasController::class;

    Route::post('/web-alias/check', [$ctr, 'check'])->name('web.alias.check');
    Route::get('/web-alias', [$ctr, 'index'])->name('web.alias.index');
    Route::post('/web-alias/update', [$ctr, 'update'])->name('web.alias.update');
    Route::post('/web-alias/change-status', [$ctr, 'change_status'])->name('web.alias.change.status');
    Route::post('/web-alias/generate-form', [$ctr, 'generate_form'])->name('web.alias.generate.form');
    Route::get('/web-alias/{uuid}/hyperlink-search', [$ctr, 'hyperlink_search'])->name('web.alias.hyperlink.search');

});