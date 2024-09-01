<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'tampilBarang']);
Route::get('/barang/tambah', [HomeController::class, 'tambahBarang']);
Route::post('/barang/tambah/process', [HomeController::class, 'prosesTambahBarang']);
Route::get('/barang/edit/{id_barang}', [HomeController::class, 'editBarang']);
Route::post('/barang/edit/process', [HomeController::class, 'editBarangProcess']);
Route::delete('/barang/delete/', [HomeController::class, 'hapusBarang']);


//tambahkan route login dan register
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login/process', [AuthController::class, 'login']);
// Route::get('/register', [AuthController::class, 'register']);
// Route::post('/register/process', [AuthController::class, 'reg']);
Route::get('/logout', [AuthController::class, 'logout']);
