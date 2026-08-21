<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk per Jurusan - Admin SMK Negeri 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>
<body>

    <div class="container">
        <div class="header">
            <div>
                <h1>Monitoring Produk Unggulan 10 Jurusan</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 3px;">Panel Admin Pusat - SMK Negeri 5 Kab. Tangerang</p>
            </div>
            <a href="/dashboard/produk/tambah" class="btn">+ Tambah Produk</a>
        </div>

        @php
            use App\Models\Jurusan;
            // Ambil semua data jurusan beserta produknya
            $semuaJurusan = Jurusan::with('produks')->get();
        @endphp

        @foreach($semuaJurusan as $j)
            <div class="jurusan-section">
                <div class="jurusan-header">
                    <span>{{ $j->nama_jurusan }}</span>
                    <span class="badge-count">{{ $j->produks->count() }} Produk</span>
                </div>

                @if($j->produks->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 45%;">Nama Produk Unggulan</th>
                                <th style="width: 25%;">Harga</th>
                                <th style="width: 25%;">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($j->produks as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $p->nama_produk }}</strong><br><small style="color: #64748b;">{{ $p->deskripsi }}</small></td>
                                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                                <td>{{ $p->stok }} pcs</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-produk">Belum ada produk unggulan yang ditambahkan untuk jurusan ini.</div>
                @endif
            </div>
        @endforeach

        <div style="margin-top: 25px;">
            <a href="/dashboard" style="font-size: 14px; color: #2563eb; text-decoration: none; font-weight: 600;">&larr; Kembali ke Dashboard Admin</a>
        </div>
    </div>

</body>
</html>