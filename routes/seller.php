<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;



Route::middleware('auth')->group(function () {
    Route::middleware('seller')->group(function () {
        Route::middleware('hasProfile')->group(function () {
            Route::resource('seller/foods', FoodController::class);
            Route::resource('seller/restaurants', RestaurantController::class);
        });
    });
});
Route::resource('seller/profiles', ProfileController::class);
