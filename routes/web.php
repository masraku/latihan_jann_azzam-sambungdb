<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SellerProdukController;

Route::middleware('guest')->group(function (){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware('role:admin')->name('admin.dashboard');
    Route::get('/buyer/dashboard', [DashboardController::class, 'buyer'])->middleware('role:buyer')->name('buyer.dashboard');

    Route::middleware('role:seller')->prefix('seller')->name('seller.')->group(function (){
        Route::get('/dashboard', [DashboardController::class, 'seller'])->name('dashboard');
        Route::post('/produk', [SellerProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{produk}/edit', [SellerProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{produk}', [SellerProdukController::class, 'update'])->name('produk.update');
        Route::delete('produk/{produk}', [SellerProdukController::class, 'destroy'])->name('produk.destroy');
    });
});





