<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body">

    <!-- SIDEBAR KIRI -->
    <div class="admin-sidebar">
        <div>
            <h2>Admin Pusat</h2>
            <a href="/dashboard">Kelola Produk</a>
            <a href="/dashboard/laporan" style="color: white; background: #1e293b;">📊 Laporan Transaksi</a>
            <a href="/register-jurusan">+ Buat Akun Jurusan Baru</a>
            <a href="/" target="_blank">Lihat Website Utama</a>
        </div>
        
        <div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" style="color: #f87171; font-weight: bold;">Logout Sistem</button>
            </form>
        </div>
    </div>

    <!-- KONTEN UTAMA KANAN -->
    <div class="admin-main">
        <div class="card">
            <h1>Laporan Rekapitulasi Transaksi</h1>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 20px;">Rekam jejak seluruh pesanan produk Teaching Factory.</p>

            <!-- Ringkasan Pendapatan -->
            <div style="background: #f8fafc; border: 1px solid #cbd5e1; padding: 15px; border-radius: 6px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <span style="font-size: 12px; color: #64748b; font-weight: 600; display: block;">TOTAL KESELURUHAN PENDAPATAN</span>
                    <span style="font-size: 20px; font-weight: 800; color: #16a34a;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                </div>
                <button onclick="window.print()" class="btn btn-edit" style="padding: 8px 15px; font-size: 12px;">🖨️ Cetak / Print Laporan</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Pembeli</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $index => $t)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong style="color: #2563eb;">{{ $t->kode_transaksi }}</strong></td>
                            <td>{{ $t->produk->nama_produk ?? 'Produk Dihapus' }}</td>
                            <td>
                                {{ $t->nama_pembeli }}<br>
                                <small style="color: #64748b;">WhatsApp: {{ $t->no_wa_pembeli }}</small>
                            </td>
                            <td>{{ $t->jumlah }} pcs</td>
                            <td><strong>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</strong></td>
                            <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #64748b; padding: 20px;">Belum ada data transaksi yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>