<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\Support;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;


Route::any('close-tab', function () {
    return "<script>window.close();</script>";
})->name('close.tab');

Auth::routes(['verify' => true]);
/*
|--------------------------------------------------------------------------
| Customer Panel
|--------------------------------------------------------------------------
|
*/
Route::namespace('Auth')->group(function () {

    Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::put('/password/update', [ChangePasswordController::class, 'updatePassword'])->name('password.update');

    // Password reset routes
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware("throttle:10,15");
    Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::put('/password/update', [ChangePasswordController::class, 'updatePassword'])->name('password.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/account/approved', [VerificationController::class, 'showApproved'])->name('verification.approved');
});

//social-login
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);
/* Customer Panel */

Route::get('/cache-clear', 'Controller@cache_clear')->name('cache.clear');


