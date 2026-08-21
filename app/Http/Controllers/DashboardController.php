<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


public function dashboard()
{
    $user = \Illuminate\Support\Facades\Auth::user();

    if ($user->role === 'admin') {
        // Ambil semua data produk untuk admin pusat
        $produks = \App\Models\Produk::all(); 
        
        // Kirim variabel $produks ke view admin.blade.php
        return view('dashboard.admin', compact('produks'));
    }

    // Kode untuk role jurusan...
}
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return view('dashboard.admin');
        } 
        
        return view('dashboard.jurusan');
    }
}