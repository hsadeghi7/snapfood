<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::middleware('hasProfile')->group(function () {

            Route::resource('/admin/users', UserController::class);
            Route::resource('/admin/categories', CategoryController::class);
            Route::resource('/admin/coupons', CouponController::class);
            Route::resource('/admin/roles', RoleController::class);
            Route::resource('/admin/permissions', PermissionController::class);
            Route::post('/admin/users', [UserController::class, 'activityToggle'])->name('users.activityToggle');

            Route::get('/admin/comments', [CommentController::class, 'index'])->name('comments.index');
            Route::get('/admin/comments/{comment}', [CommentController::class, 'restore'])->name('comments.restore');
            Route::delete('/admin/comments/{comment}', [CommentController::class, 'delete'])->name('comments.delete');

            
        });
    });
});
