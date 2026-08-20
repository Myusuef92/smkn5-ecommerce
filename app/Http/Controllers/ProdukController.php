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
        return view('produk.create', compact('jurusans'));
    }

    // Menampilkan halaman detail produk untuk publik
    public function show($id)
    {
        $produk = Produk::with('jurusan')->findOrFail($id);
        return view('produk.detail', compact('produk'));
    }

   public function store(\Illuminate\Http\Request $request)
{
    $user = Auth::user();

    // Otomatis tentukan jurusan_id: jika admin pakai pilihan, jika jurusan pakai ID miliknya sendiri
    $jurusanId = ($user->role === 'admin') ? $request->jurusan_id : $user->jurusan_id;

    // Pengaman jika akun jurusan belum terikat di database
    if (!$jurusanId) {
        $jurusanId = 1; // Default aman
    }

    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'deskripsi' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('produk_images', 'public');
    }

    \App\Models\Produk::create([
        'jurusan_id' => $jurusanId,
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'deskripsi' => $request->deskripsi,
        'gambar' => $gambarPath,
    ]);

    return redirect('/dashboard')->with('success', 'Produk unggulan berhasil ditambahkan!');
}

    public function destroy($id)
{
    $produk = Produk::findOrFail($id);
    
    // Hapus file gambar fisik jika ada
    if ($produk->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->gambar)) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->gambar);
    }
    
    $produk->delete();

    return redirect('/dashboard')->with('success', 'Produk berhasil dihapus!');
} 

// Menampilkan halaman form edit produk
    public function edit($id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        $jurusans = \App\Models\Jurusan::all();
        
        // Ubah dari 'produk.edit' menjadi 'admin.produk.edit'
        return view('admin.produk.edit', compact('produk', 'jurusans'));
    }

    // Memproses perubahan data produk
    public function update(\Illuminate\Http\Request $request, $id)
    {
        $produk = \App\Models\Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        $jurusanId = ($user->role === 'admin') ? $request->jurusan_id : $produk->jurusan_id;

        $gambarPath = $produk->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->gambar);
            }
            $gambarPath = $request->file('gambar')->store('produk_images', 'public');
        }

        $produk->update([
            'jurusan_id' => $jurusanId,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect('/dashboard')->with('success', 'Produk unggulan berhasil diperbarui!');
    }

}