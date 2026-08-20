<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Pusat - SMKN 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background: #f1f5f9; min-height: 100vh; }
        .sidebar { width: 250px; background: #0f172a; color: white; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; }
        .sidebar h2 { font-size: 15px; margin-bottom: 30px; color: #38bdf8; text-transform: uppercase; }
        .sidebar a, .sidebar button { display: block; color: #94a3b8; padding: 10px; text-decoration: none; border-radius: 4px; margin-bottom: 5px; background: none; border: none; text-align: left; width: 100%; cursor: pointer; font-size: 13px; }
        .sidebar a:hover, .sidebar button:hover { background: #1e293b; color: white; }
        .main { flex: 1; padding: 30px; overflow-x: auto; }
        .card { background: white; padding: 20px; border-radius: 8px; border: 1px solid #cbd5e1; }
        h1 { font-size: 18px; margin-bottom: 15px; color: #1e293b; font-weight: 800; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 13px; }
        th, td { padding: 10px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        th { background: #f8fafc; color: #334155; font-weight: 700; }
        .btn { padding: 5px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; text-decoration: none; cursor: pointer; border: none; }
        .btn-add { background: #e60012; color: white; margin-bottom: 15px; display: inline-block; }
        .btn-edit { background: #2563eb; color: white; }
        .btn-delete { background: #dc2626; color: white; }
        .alert-success { background: #f0fdf4; color: #16a34a; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <h2>Admin Pusat</h2>
            <a href="/dashboard">Kelola Semua Produk</a>
            <a href="/dashboard/register-jurusan">+ Buat Akun Jurusan Baru</a>
            <a href="/" target="_blank">Lihat Website Utama</a>
            
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="color: #f87171;">Logout Sistem</button>
        </form>
    </div>

    <div class="main">
        <div class="card">
            <h1>Manajemen Seluruh Produk (Admin Pusat)</h1>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 15px;">Anda memiliki hak akses penuh untuk mengelola produk dari ke-10 jurusan.</p>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <a href="/dashboard/produk/tambah" class="btn btn-add">+ Tambah Produk Baru</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($p->gambar)
                                    <img src="{{ asset('storage/' . $p->gambar) }}" alt="Foto" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #cbd5e1;">
                                @else
                                    <span style="font-size: 10px; color: #94a3b8;">Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $p->nama_produk }}</td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>{{ $p->stok }}</td>
                            <td>
                                <a href="/dashboard/produk/edit/{{ $p->id }}" class="btn btn-edit">Edit</a>
                                <form action="/dashboard/produk/hapus/{{ $p->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">Belum ada produk untuk jurusan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>