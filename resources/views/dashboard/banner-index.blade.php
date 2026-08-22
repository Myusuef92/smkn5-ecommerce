<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Banner - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body">

    <div class="admin-sidebar">
        <div>
            <h2>Admin Pusat</h2>
            <a href="/dashboard">Kelola Produk</a>
            <a href="/dashboard/laporan">📊 Laporan Transaksi</a>
            <a href="/dashboard/banner" style="color: white; background: #1e293b;">🖼️ Kelola Banner Slider</a>
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

    <div class="admin-main">
        <div class="card">
            <h1>Manajemen Slider Banner Beranda</h1>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 20px;">Kelola gambar promosi dan atur status tampilnya di halaman utama.</p>

            @if(session('success'))
                <div class="alert-success" style="margin-bottom: 15px;">{{ session('success') }}</div>
            @endif

            <a href="/dashboard/banner/tambah" class="btn btn-add">+ Tambah Banner Baru</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul Banner</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $index => $b)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $b->gambar) }}" alt="Banner" style="width: 120px; height: 50px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>{{ $b->judul ?? '-' }}</td>
                            <td>
                                @if($b->status === 'aktif')
                                    <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;">AKTIF</span>
                                @else
                                    <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold;">NON-AKTIF</span>
                                @endif
                            </td>
                            <td>
                                <!-- Tombol Ubah Status -->
                                <form action="/dashboard/banner/status/{{ $b->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="padding: 6px 10px; background: {{ $b->status === 'aktif' ? '#ca8a04' : '#16a34a' }}; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                                        {{ $b->status === 'aktif' ? 'Non-aktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                <a href="/dashboard/banner/edit/{{ $b->id }}" class="btn btn-edit" style="text-decoration: none; display: inline-block; padding: 6px 12px; background: #2563eb; color: white; border-radius: 4px; font-size: 12px;">Edit</a>
                                
                                <form action="/dashboard/banner/hapus/{{ $b->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #64748b; padding: 20px;">Belum ada banner yang diunggah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>