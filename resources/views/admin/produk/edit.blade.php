<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page"> <!-- Tambahkan class center-page di sini -->

    <div class="form-card">
        <h2>Edit Produk Unggulan</h2>

        <form action="/dashboard/produk/update/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(Auth::user()->role === 'admin')
                <div class="form-group">
                    <label>Pilih Jurusan</label>
                    <select name="jurusan_id" class="form-control" required>
                        @foreach($jurusans as $j)
                            <option value="{{ $j->id }}" {{ $produk->jurusan_id == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
            </div>

            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control">{{ $produk->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label>Foto Produk Saat Ini</label>
                @if($produk->gambar)
                    <div style="margin-bottom: 8px;"><img src="{{ asset('storage/' . $produk->gambar) }}" alt="Preview" style="height: 60px; border-radius: 4px; object-fit: cover;"></div>
                @else
                    <p style="font-size: 11px; color: #64748b; margin-bottom: 8px;">Belum ada foto.</p>
                @endif
                <label>Ganti Foto (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" style="font-size: 12px;">
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>

        <a href="/dashboard" class="back-link">&larr; Kembali ke Dashboard</a>
    </div>

</body>
</html>