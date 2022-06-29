<?php

use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\WorkingHourController;

Route::middleware('auth')->group(function () {
    Route::middleware('seller')->group(function () {
        Route::middleware('hasProfile')->group(function () {
            Route::resource('seller/foods', FoodController::class);
            Route::resource('seller/restaurants', RestaurantController::class);
            Route::resource('seller/workingHours', WorkingHourController::class);
            Route::resource('seller/menus', MenuController::class);

            Route::post('seller/restaurant', [RestaurantController::class, 'statusToggle'])->name('restaurant.statusToggle');
            Route::post('seller/food', [FoodController::class, 'statusToggle'])->name('food.statusToggle');
            Route::post('seller/menu', [MenuController::class, 'showMenu'])->name('showMenu');
        });
    });
    Route::resource('seller/profiles', ProfileController::class);
});

