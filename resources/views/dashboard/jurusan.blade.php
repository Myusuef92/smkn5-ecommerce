<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Jurusan - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body"> 

    <!-- SIDEBAR KIRI -->
    <div class="admin-sidebar">
        <div>
            <h2>{{ Auth::user()->jurusan->nama_jurusan ?? 'Pengelola Jurusan' }}</h2>
            <a href="/dashboard">Produk Jurusan Saya</a>
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
            <h1>Dashboard Produk: {{ Auth::user()->jurusan->nama_jurusan ?? 'Jurusan Belum Diset' }}</h1>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 15px;">Kelola produk unggulan khusus untuk jurusan Anda.</p>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <<a href="/tambah-produk" class="btn btn-add">+ Tambah Produk Baru</a>

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
                                    <img src="{{ asset('storage/' . $p->gambar) }}" alt="Foto" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <span style="font-size: 11px; color: #94a3b8;">Tidak ada</span>
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
                            <td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">Belum ada produk yang diinput untuk jurusan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>