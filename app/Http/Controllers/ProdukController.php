<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // Menampilkan daftar produk milik jurusan pengelola yang sedang login
    public function index()
    {
        $user = Auth::user();
        
        // Jika Admin, tampilkan semua produk dari 10 jurusan
        if ($user->role === 'admin') {
            $produks = Produk::with('jurusan')->get();
            return view('admin.produk.index', compact('produks'));
        }

        // Jika Pengelola Jurusan, tampilkan produk jurusannya sendiri
        $jurusan = Jurusan::find($user->jurusan_id);
        $produks = $jurusan ? $jurusan->produks : collect();
        
        return view('jurusan.produk.index', compact('produks', 'jurusan'));
    }

    // Form tambah produk
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('jurusan.produk.create', compact('jurusans'));
    }

    // Menampilkan halaman detail produk untuk publik
    public function show($id)
    {
        $produk = Produk::with('jurusan')->findOrFail($id);
        return view('produk.detail', compact('produk'));
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        $user = Auth::user();
        $jurusanId = $user->role === 'admin' ? $request->jurusan_id : $user->jurusan_id;

        Produk::create([
            'jurusan_id' => $jurusanId,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/dashboard/produk')->with('success', 'Produk unggulan berhasil ditambahkan!');
    }
}