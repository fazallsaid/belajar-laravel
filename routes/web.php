<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/barang',[HomeController::class, 'tampilBarang']);
Route::get('/barang/tambah', [HomeController::class, 'tambahBarang']);
Route::post('/barang/tambah/process', [HomeController::class, 'prosesTambahBarang']);
Route::get('/barang/edit/{id_barang}', [HomeController::class, 'editBarang']);
Route::post('/barang/edit/process', [HomeController::class, 'editBarangProcess']);
Route::delete('/barang/delete/', [HomeController::class, 'hapusBarang']);

Route::post('cart/process', [HomeController::class, 'addToCart']);
Route::get('cart', [HomeController::class, 'Cart']);
Route::post('cart/update', [HomeController::class, 'updateCart']);


//tambahkan route login dan register
Route::get('/login',[AuthController::class, 'index']);
Route::post('/login/process', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register/process', [AuthController::class, 'reg']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard',[DashboardController::class, 'index']);
