<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RestaurantController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('buyer/register', [UserController::class, 'register']);
Route::post('buyer/login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->prefix('buyer')->group(function(){
    Route::post('logout', [UserController::class, 'logout']);

    Route::post('profile/create',[ProfileController::class, 'createProfile']);
    Route::put('profile/update/{profile}',[ProfileController::class, 'updateProfile']);
    
    Route::post('addAddress',[AddressController::class, 'addAddress']);
    Route::put('setDefaultAddress/{address}',[AddressController::class, 'setDefaultAddress']);
    Route::delete('deleteAddress/{address}',[AddressController::class, 'deleteAddress']);
    Route::post('addAddress',[AddressController::class, 'addAddress']);
    Route::get('addresses',[AddressController::class, 'addresses']);

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show']);

    Route::get('/restaurants/{restaurant}/foods', [RestaurantController::class, 'restaurantFoods']);
    
    
    Route::get('/carts', [CartController::class, 'index']);
    Route::post('/carts', [CartController::class, 'store']);
    Route::put('/carts/add/{cartItem}', [CartController::class, 'addItem']);
    Route::put('/carts/remove/{cartItem}', [CartController::class, 'removeItem']);
    Route::delete('/carts/{restaurant}', [CartController::class, 'delete']);
    Route::post('/carts/pay/{restaurant}', [PaymentController::class, 'pay']);
    
});



