<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Jurusan;
use App\Models\Transaksi;
use App\Models\Banner;

/*
|--------------------------------------------------------------------------
| Halaman Publik (Beranda & Detail Produk)
|--------------------------------------------------------------------------
*/

// Halaman Beranda (Pencarian, Filter Jurusan, dan Banner Aktif)
Route::get('/', function (Request $request) {
    $query = Produk::with('jurusan');

    if ($request->has('cari') && $request->cari != '') {
        $query->where('nama_produk', 'like', '%' . $request->cari . '%');
    }

    if ($request->has('jurusan') && $request->jurusan != '') {
        $query->where('jurusan_id', $request->jurusan);
    }

    $produks = $query->get();
    $jurusans = Jurusan::all();
    $banners = Banner::where('status', 'aktif')->latest()->get();

    return view('welcome', compact('produks', 'jurusans', 'banners'));
});

// Halaman Detail Produk & Tombol WhatsApp
Route::get('/produk/{id}', function ($id) {
    $produk = Produk::with('jurusan')->findOrFail($id);
    return view('produk.detail', compact('produk'));
});

/*
|--------------------------------------------------------------------------
| Autentikasi (Login & Logout)
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password yang Anda masukkan salah.',
    ])->onlyInput('email');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama (Admin & Jurusan)
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $produks = Produk::all();
            return view('dashboard.admin', compact('produks'));
        }
        $produks = Produk::where('jurusan_id', $user->jurusan_id)->get();
        return view('dashboard.jurusan', compact('produks'));
    });

    // Laporan Transaksi (Khusus Admin)
    Route::get('/dashboard/laporan', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }
        $transaksis = Transaksi::with('produk.jurusan')->latest()->get();
        $totalPendapatan = $transaksis->sum('total_harga');
        return view('dashboard.laporan', compact('transaksis', 'totalPendapatan'));
    });

    // Pendaftaran Akun Jurusan (Khusus Admin)
    Route::get('/register-jurusan', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }
        $jurusans = Jurusan::all();
        return view('auth.register-jurusan', compact('jurusans'));
    });

    Route::post('/register-jurusan', function (Request $request) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'jurusan',
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect('/dashboard')->with('success', 'Akun jurusan berhasil dibuat.');
    });

   // Form Tambah Produk (Mendukung rute /tambah-produk dan /dashboard/produk/tambah)
    Route::get('/tambah-produk', function () {
        $user = Auth::user();
        $jurusans = Jurusan::all();
        return view('produk.create', compact('jurusans', 'user'));
    });

    Route::get('/dashboard/produk/tambah', function () {
        $user = Auth::user();
        $jurusans = Jurusan::all();
        return view('produk.create', compact('jurusans', 'user'));
    });

    // Proses Simpan Produk Baru
    Route::post('/tambah-produk', function (Request $request) {
        $user = Auth::user();

        // Validasi input dasar
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Jika user adalah admin, validasi bahwa jurusan_id harus dipilih
        if ($user->role === 'admin') {
            $request->validate([
                'jurusan_id' => 'required|exists:jurusans,id',
            ]);
            $jurusanId = $request->jurusan_id;
        } else {
            // Jika user adalah jurusan, otomatis ambil jurusan_id dari akun yang sedang login
            $jurusanId = $user->jurusan_id;
        }

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'jurusan_id' => $jurusanId,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect('/dashboard')->with('success', 'Produk baru berhasil ditambahkan.');
    });
    
    // Form Edit Produk (Bisa diakses Admin & Jurusan)
    Route::get('/dashboard/produk/edit/{id}', function ($id) {
        $produk = \App\Models\Produk::findOrFail($id);
        $jurusans = \App\Models\Jurusan::all();
        return view('produk.edit', compact('produk', 'jurusans'));
    });

    // Proses Update Produk
    Route::put('/dashboard/produk/update/{id}', function (\Illuminate\Http\Request $request, $id) {
        $produk = \App\Models\Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'jurusan_id' => 'required|exists:jurusans,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->gambar);
            }
            $produk->gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'jurusan_id' => $request->jurusan_id,
            'deskripsi' => $request->deskripsi,
            'gambar' => $produk->gambar,
        ]);

        return redirect('/dashboard')->with('success', 'Produk berhasil diperbarui.');
    });

    Route::delete('/dashboard/produk/hapus/{id}', function ($id) {
        $produk = Produk::findOrFail($id);
        if ($produk->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();

        return redirect('/dashboard')->with('success', 'Produk berhasil dihapus.');
    });

    // Manajemen Slider Banner (Khusus Admin)
    Route::get('/dashboard/banner', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }
        $banners = Banner::latest()->get();
        return view('dashboard.banner-index', compact('banners'));
    });

    Route::get('/dashboard/banner/tambah', function () {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }
        return view('dashboard.banner-create');
    });

    Route::post('/dashboard/banner/simpan', function (Request $request) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar')->store('banners', 'public');

        Banner::create([
            'judul' => $request->judul,
            'gambar' => $path,
            'status' => 'aktif',
        ]);

        return redirect('/dashboard/banner')->with('success', 'Banner berhasil ditambahkan.');
    });

    Route::get('/dashboard/banner/edit/{id}', function ($id) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }
        $banner = Banner::findOrFail($id);
        return view('dashboard.banner-edit', compact('banner'));
    });

    Route::put('/dashboard/banner/update/{id}', function (Request $request, $id) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        $banner = Banner::findOrFail($id);

        $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($banner->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($banner->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($banner->gambar);
            }
            $banner->gambar = $request->file('gambar')->store('banners', 'public');
        }

        $banner->update([
            'judul' => $request->judul,
            'gambar' => $banner->gambar,
        ]);

        return redirect('/dashboard/banner')->with('success', 'Banner berhasil diperbarui.');
    });

    Route::patch('/dashboard/banner/status/{id}', function ($id) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        $banner = Banner::findOrFail($id);
        $banner->status = $banner->status === 'aktif' ? 'nonaktif' : 'aktif';
        $banner->save();

        return redirect('/dashboard/banner')->with('success', 'Status banner berhasil diubah.');
    });

    Route::delete('/dashboard/banner/hapus/{id}', function ($id) {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        $banner = Banner::findOrFail($id);
        if ($banner->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($banner->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($banner->gambar);
        }
        $banner->delete();

        return redirect('/dashboard/banner')->with('success', 'Banner berhasil dihapus.');
    });

});