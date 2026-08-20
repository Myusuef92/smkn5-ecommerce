<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Models\Jurusan ;
use App\Models\Produk;

// Halaman Utama Publik (Sekaligus Form Login Terintegrasi)
Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-proses', [AuthController::class, 'login'])->name('login.proses');


//Registrasi Jurusan (Hanya untuk Admin)
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard/register-jurusan', function () {
        return view('admin.register-jurusan');
    });
    
Route::post('/dashboard/register-jurusan', [AuthController::class, 'storeJurusanAccount'])->name('admin.store-jurusan');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Publik Detail Produk
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail');

// Rute Dashboard & Manajemen Produk (Dilindungi pengecekan Auth manual)
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
    }
    
    $user = Auth::user();
    if ($user->role === 'admin') {
        return view('dashboard.admin');
    }
    return view('dashboard.jurusan');
});

// Manajemen Produk
Route::get('/dashboard/produk', [ProdukController::class, 'index']);
Route::get('/dashboard/produk/tambah', [ProdukController::class, 'create']);
Route::post('/dashboard/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard/produk/edit/{id}', [ProdukController::class, 'edit']);
Route::put('/dashboard/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
});
// Rute Manajemen Produk (Edit & Hapus)
Route::delete('/dashboard/produk/hapus/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
// (Opsional jika Anda membuat fungsi edit)
// Route::get('/dashboard/produk/edit/{id}', [ProdukController::class, 'edit']);
// Route::put('/dashboard/produk/update/{id}', [ProdukController::class, 'update']);