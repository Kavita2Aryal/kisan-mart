<?php

use App\Http\Controllers\Build\ListGroupController;
use App\Http\Controllers\Build\SectionConfigController;
use App\Http\Controllers\Build\DomainFixerController;

Route::middleware(['auth', 'no.lockscreen', 'super.auth'])->prefix('admin')->group(function () {

    Route::get('/fix-domain', [DomainFixerController::class, 'change'])->name('domain.fixer');

    Route::prefix('list-group')->name('list.group.')->group(function () {
        
        $ctr = ListGroupController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::post('/generate-form', [$ctr, 'generate_form'])->name('generate.form');
        Route::get('/reset', [$ctr, 'reset'])->name('reset');
    });

    Route::prefix('section-config')->name('section.config.')->group(function () {
        
        $ctr = SectionConfigController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::get('/sort', [$ctr, 'sort'])->name('sort');
        Route::post('/upload-image', [$ctr, 'upload_image'])->name('upload.image');
        Route::post('/remove-image', [$ctr, 'remove_image'])->name('remove.image');
        Route::post('/generate-form', [$ctr, 'generate_form'])->name('generate.form');
        Route::put('/{uuid}/get-section', [$ctr, 'get_section'])->name('get.section');
    });
});