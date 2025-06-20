<?php

use App\Http\Controllers\Addons\ContactMessageController;
use App\Http\Controllers\Addons\QuickLinkController;
use App\Http\Controllers\Addons\SocialMediaController;
use App\Http\Controllers\Addons\FaqController;
use App\Http\Controllers\Addons\TeamController;
use App\Http\Controllers\Addons\TestimonialController;
use App\Http\Controllers\Addons\PartnerController;
use App\Http\Controllers\Addons\BlogController;
use App\Http\Controllers\Addons\BlogCategoryController;
use App\Http\Controllers\Addons\AuthorController;
use App\Http\Controllers\Addons\EmailTemplateController;
use App\Http\Controllers\Addons\MailChimpController;
use App\Http\Controllers\Addons\NewsletterController;

Route::middleware(['auth', 'no.lockscreen'])->prefix('admin')->group(function () {

    Route::middleware('can:contact.all')->prefix('contacts')->name('contact.')->group(function () {

        $ctr = ContactMessageController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/export/csv', [$ctr, 'export_csv'])->name('export.csv');
        Route::get('/export/pdf', [$ctr, 'export_pdf'])->name('export.pdf');
    });

    Route::middleware('can:newsletter.all')->group(function () {

        $ctr = NewsletterController::class;
        Route::get('/newsletters', [$ctr, 'index'])->name('newsletter.index');
        Route::get('/newsletters/export/csv', [$ctr, 'export_csv'])->name('newsletter.export.csv');
        Route::get('/newsletters/export/pdf', [$ctr, 'export_pdf'])->name('newsletter.export.pdf');
    });

    Route::middleware('can:quick.link.all')->prefix('quick-link')->name('quick.link.')->group(function () {

        $ctr = QuickLinkController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::post('/manage-order', [$ctr, 'manage_order'])->name('manage.order');
        Route::get('/{group_id}/sort', [$ctr, 'sort'])->name('sort');
    });

    Route::middleware('can:social.media.all')->prefix('social-media')->name('social.media.')->group(function () {

        $ctr = SocialMediaController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::post('/manage-order', [$ctr, 'manage_order'])->name('manage.order');
        Route::get('/sort', [$ctr, 'sort'])->name('sort');
    });

    Route::middleware('can:faq.all')->prefix('faq')->name('faq.')->group(function () {

        $ctr = FaqController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::post('/manage-order', [$ctr, 'manage_order'])->name('manage.order');
        Route::get('/sort', [$ctr, 'sort'])->name('sort');
    });

    Route::middleware('can:team.all')->prefix('team')->name('team.')->group(function () {

        $ctr = TeamController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::post('/manage-order', [$ctr, 'manage_order'])->name('manage.order');
        Route::get('/{group_id}/sort', [$ctr, 'sort'])->name('sort');
    });

    Route::middleware('can:testimonial.all')->prefix('testimonial')->name('testimonial.')->group(function () {

        $ctr = TestimonialController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::post('/manage-order', [$ctr, 'manage_order'])->name('manage.order');
        Route::get('/sort', [$ctr, 'sort'])->name('sort');
    });

    Route::middleware('can:partner.all')->prefix('partner')->name('partner.')->group(function () {

        $ctr = PartnerController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        Route::post('/manage-order', [$ctr, 'manage_order'])->name('manage.order');
        Route::get('/sort', [$ctr, 'sort'])->name('sort');
    });

    Route::middleware('can:blog.all')->group(function () {

        Route::prefix('blog')->name('blog.')->group(function () {

            $ctr = BlogController::class;
            Route::post('/generate-form', [$ctr, 'generate_form'])->name('generate.form');
            Route::get('/blog', [$ctr, 'index'])->name('index');
            Route::put('/{uuid}/check', [$ctr, 'check'])->name('check');
            Route::get('/create', [$ctr, 'create'])->name('create');
            Route::post('/store', [$ctr, 'store'])->name('store');
            Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
            Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
            Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');

            Route::get('/trash', [$ctr, 'trash'])->name('trash');
            Route::put('/{uuid}/restore', [$ctr, 'restore'])->name('restore');
            Route::delete('/{uuid}/soft-delete', [$ctr, 'soft_delete'])->name('softdelete');
            Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        });

        Route::prefix('blog-category')->name('blog.category.')->group(function () {

            $ctr = BlogCategoryController::class;
            Route::get('/', [$ctr, 'index'])->name('index');
            Route::get('/create', [$ctr, 'create'])->name('create');
            Route::post('/store', [$ctr, 'store'])->name('store');
            Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
            Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
            Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
        });
    });

    Route::middleware('can:author.all')->prefix('author')->name('author.')->group(function () {

        $ctr = AuthorController::class;
        Route::get('/', [$ctr, 'index'])->name('index');
        Route::get('/create', [$ctr, 'create'])->name('create');
        Route::post('/store', [$ctr, 'store'])->name('store');
        Route::get('/{uuid}/edit', [$ctr, 'edit'])->name('edit');
        Route::put('/{uuid}/update', [$ctr, 'update'])->name('update');
        Route::delete('/{uuid}/destroy', [$ctr, 'destroy'])->name('destroy');
        Route::put('/{uuid}/change-status', [$ctr, 'change_status'])->name('change.status');
    });

    Route::middleware('can:email.template.all')->group(function () {

        $ctr = EmailTemplateController::class;
        Route::get('/email-template', [$ctr, 'index'])->name('email.template.index');
        Route::get('/email-template/create', [$ctr, 'create'])->name('email.template.create');
        Route::post('/email-template/store', [$ctr, 'store'])->name('email.template.store');
        Route::get('/email-template/{uuid}/edit', [$ctr, 'edit'])->name('email.template.edit');
        Route::put('/email-template/{uuid}/update', [$ctr, 'update'])->name('email.template.update');
    });

    Route::middleware('can:mailchimp.status')->group(function () {

        $ctr = MailChimpController::class;
        Route::get('/mailchimp', [$ctr, 'index'])->name('mailchimp.index');
        Route::post('/mailchimp/send-email', [$ctr, 'send_mail'])->name('mailchimp.compose.email');
    });
});
