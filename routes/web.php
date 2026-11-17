<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::inertia('/', 'welcome')->name('home');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/filter', [ProdukController::class, 'filter'])->name('produk.filter');
Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
