<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::inertia('/', 'welcome')->name('home');
Route::get('/produk', [ProdukController::class, 'index']);
Route::post('/produk', [ProdukController::class, 'store']);
