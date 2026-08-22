<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $produk->nama_produk }} - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page">

    <div class="form-card" style="max-width: 800px; display: grid; grid-template-columns: 1fr 1fr; gap: 25px; align-items: center;">
        
        <!-- Kolom Gambar -->
        <div>
            @if($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Foto" style="width: 100%; height: 260px; object-fit: cover; border-radius: 6px;">
            @else
                <div style="background: #e2e8f0; height: 260px; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #64748b; border-radius: 6px;">Tidak Ada Foto</div>
            @endif
        </div>

        <!-- Kolom Informasi Produk & Tombol WhatsApp -->
        <div>
            <span class="badge-jurusan">{{ $produk->jurusan->nama_jurusan ?? 'Umum' }}</span>
            <h2 style="font-size: 17px; margin-bottom: 8px; color: #1e293b;">{{ $produk->nama_produk }}</h2>
            <div class="product-price" style="font-size: 18px; margin-bottom: 10px;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
            <p style="font-size: 12px; color: #64748b; margin-bottom: 15px; line-height: 1.5;">{{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}</p>
            <p style="font-size: 12px; font-weight: 600; color: #16a34a; margin-bottom: 20px;">Stok Tersedia: {{ $produk->stok }} pcs</p>

            <!-- Tombol Pesan WhatsApp Otomatis -->
            @php
                $noWa = "6281234567890"; // Ganti dengan nomor WhatsApp Admin/Jurusan Anda
                $pesan = "Halo, saya tertarik untuk memesan produk *{$produk->nama_produk}* seharga Rp " . number_format($produk->harga, 0, ',', '.') . " apakah stoknya masih ada?";
                $linkWa = "https://wa.me/{$noWa}?text=" . urlencode($pesan);
            @endphp
            
            <a href="{{ $linkWa }}" target="_blank" class="btn-submit" style="background: #25d366; text-align: center; text-decoration: none; display: block; margin-bottom: 10px; padding: 10px; border-radius: 4px; color: white; font-weight: bold; font-size: 13px;">Pesan via WhatsApp</a>
            <a href="/" class="back-link" style="text-align: center; display: block;">&larr; Kembali ke Beranda</a>
        </div>

    </div>

</body>
</html>