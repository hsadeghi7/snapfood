<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::middleware('hasProfile')->prefix('admin')->group(function () {

            Route::resource('/users', UserController::class);
            Route::resource('/categories', CategoryController::class);
            Route::resource('/coupons', CouponController::class);
            Route::resource('/roles', RoleController::class);
            Route::resource('/permissions', PermissionController::class);
            Route::post('/users', [UserController::class, 'activityToggle'])->name('users.activityToggle');

            Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
            Route::get('/comments/{comment}', [CommentController::class, 'restore'])->name('comments.restore');
            Route::delete('/comments/{comment}', [CommentController::class, 'delete'])->name('comments.delete');

            Route::resource('/banners', BannerController::class);
        });
    });
});
