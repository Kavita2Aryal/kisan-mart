<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;

Route::middleware(['auth', 'throttle:100,10'])->prefix('admin')->group(function () {

    Route::get('/locked', [AuthController::class, 'locked'])->name('lockscreen.locked');
    Route::post('/lock', [AuthController::class, 'lock'])->name('lockscreen.lock');
    Route::put('/unlock', [AuthController::class, 'unlock'])->name('lockscreen.unlock');
    Route::get('/secret-logout', [AuthController::class, 'secretLogout'])->name('secret.logout');
});

Route::middleware(['auth', 'no.lockscreen', 'throttle:100,10'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/deactivate', [ProfileController::class, 'deactivateAccount'])->name('profile.deactivate')->middleware(['cannot:super.auth', 'password.confirm']);
    Route::get('/profile/logout/other', [ProfileController::class, 'logoutOtherDevices'])->name('profile.logout.other')->middleware('password.confirm');
});