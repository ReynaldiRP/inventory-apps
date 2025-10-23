<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard-new');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);
    Route::resource('product-types', ProductTypeController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('receipts', ReceiptController::class);

    Route::group(['prefix' => 'dashboard-analytics'], function () {
        Route::controller(\App\Http\Controllers\DashboardController::class)->group(function () {
            Route::get('/product-out-current-month', 'productOutCurrentMonth')->name('dashboard.productOutCurrentMonth');
            Route::get('/product-in-current-month', 'productInCurrentMonth')->name('dashboard.productInCurrentMonth');
            Route::get('/product-warning-stock', 'productWarningStock')->name('dashboard.productWarningStock');
            Route::get('/product-out-per-month', 'productOutPerMonth')->name('dashboard.productOutPerMonth');
            Route::get('/product-in-per-month', 'productInPerMonth')->name('dashboard.productInPerMonth');
            Route::get('/newest-receipts', 'newestReceipts')->name('dashboard.newestReceipts');
        });
    });
});


require __DIR__ . '/auth.php';
