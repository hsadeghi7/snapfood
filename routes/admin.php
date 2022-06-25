<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CategoryController;


Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::middleware('hasProfile')->group(function () {

            Route::resource('/admin/users', UserController::class);
            Route::resource('/admin/categories', CategoryController::class);
            Route::resource('/admin/coupons', CouponController::class);
            Route::post('/admin/users', [UserController::class, 'activityToggle'])->name('users.activityToggle');
        });
    });
});
