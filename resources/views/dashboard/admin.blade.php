<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Pusat - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body">

    <!-- SIDEBAR KIRI (Hanya 1 Kali) -->
    <div class="admin-sidebar">
        <div>
            <h2>ADMIN PUSAT</h2>
            <a href="/dashboard" style="color: white; background: #1e293b;">Kelola Produk</a>
            <a href="/dashboard/laporan">📊 Laporan Transaksi</a>
            <a href="/dashboard/banner">🖼️ Kelola Banner Slider</a>
            <a href="/register-jurusan">+ Buat Akun Jurusan Baru</a>
            <a href="/" target="_blank">Lihat Website Utama</a>
        </div>
        
        <div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" style="color: #f87171; font-weight: bold; background: none; border: none; cursor: pointer; padding: 0;">Logout Sistem</button>
            </form>
        </div>
    </div>

    <!-- KONTEN UTAMA KANAN -->
    <div class="admin-main">
        <div class="card">
            <h1>Manajemen Seluruh Produk (Admin Pusat)</h1>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 20px;">Anda memiliki hak akses penuh untuk mengelola produk dari ke-10 jurusan.</p>

            @if(session('success'))
                <div class="alert-success" style="margin-bottom: 15px;">{{ session('success') }}</div>
            @endif

            <a href="/tambah-produk" class="btn btn-add">+ Tambah Produk Baru</a>

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
                                    <img src="{{ asset('storage/' . $p->gambar) }}" alt="Foto" style="width: 50px; height: 40px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <span style="color: #94a3b8; font-size: 11px;">Tidak ada</span>
                                @endif
                            </td>
                            <td><strong>{{ $p->nama_produk }}</strong><br><small style="color: #64748b;">{{ $p->jurusan->nama_jurusan ?? 'Umum' }}</small></td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>{{ $p->stok }} pcs</td>
                            <td>
                                <a href="/dashboard/produk/edit/{{ $p->id }}" class="btn btn-edit">Edit</a>
                                <form action="/hapus-produk/{{ $p->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">Belum ada produk terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>