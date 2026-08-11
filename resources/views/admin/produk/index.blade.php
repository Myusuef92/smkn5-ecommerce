<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk per Jurusan - Admin SMK Negeri 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8fafc; color: #334155; padding: 30px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px; }
        .header h1 { font-size: 22px; color: #1e293b; font-weight: 700; }
        .btn { background: #2563eb; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; }
        .btn:hover { background: #1d4ed8; }
        .jurusan-section { margin-bottom: 30px; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: #ffffff; }
        .jurusan-header { background: #f1f5f9; padding: 12px 20px; font-weight: 700; color: #1e293b; font-size: 15px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 20px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        th { background: #fafafa; font-weight: 600; color: #64748b; font-size: 13px; text-transform: uppercase; }
        tr:last-child td { border-bottom: none; }
        .empty-produk { padding: 15px 20px; color: #94a3b8; font-size: 13px; font-style: italic; }
        .badge-count { background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 12px; font-size: 12px; font-weight: 600; }
    </style>
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