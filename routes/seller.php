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
            Route::get('seller/restaurants/delivery/{restaurant}', [RestaurantController::class, 'deliveryFee'])->name('restaurants.deliveryFee');
            Route::post('seller/restaurants/delivery/{restaurant}', [RestaurantController::class, 'setDeliveryFee'])->name('restaurants.setDeliveryFee');
            
        });
    });
    Route::resource('seller/profiles', ProfileController::class);
});

Route::post('seller/food/getCategories', [FoodController::class, 'getCategories']);


