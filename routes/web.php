<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;

 

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect('/login');
});

// Rute Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute Setelah Login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

   

// Rute Tamu (Belum Login)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Tambahkan rute register di sini
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// Tambahkan di dalam Route::middleware(['auth'])->group(function () { ... });
Route::get('/dashboard/produk', [ProdukController::class, 'index']);
Route::get('/dashboard/produk/tambah', [ProdukController::class, 'create']);
Route::post('/dashboard/produk', [ProdukController::class, 'store'])->name('produk.store');


// Rute Publik Detail Produk
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail');
});