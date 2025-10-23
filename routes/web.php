<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductTypeController;


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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/product-types', [ProductTypeController::class, 'index'])->name('product-types.index');
    Route::get('/product-types/create', [ProductTypeController::class, 'create'])->name('product-types.create');
    Route::post('/product-types', [ProductTypeController::class, 'store'])->name('product-types.store');
    Route::get('/product-types/{id}/edit', [ProductTypeController::class, 'edit'])->name('product-types.edit');
    Route::put('/product-types/{id}', [ProductTypeController::class, 'update'])->name('product-types.update');
    Route::delete('/product-types/{id}', [ProductTypeController::class, 'destroy'])->name('product-types.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/product-types', [ProductTypeController::class, 'index'])->name('product-types.index');

});

require __DIR__.'/auth.php';
