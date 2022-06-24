<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;


Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::resource('/admin/category', CategoryController::class);
        Route::resource('/admin/coupon', CouponController::class);
    });
    
});
