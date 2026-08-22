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
    
    <!-- Pastikan input-input data produk ada di sini -->
    <div class="form-group" style="margin-bottom: 15px;">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Kompetensi Keahlian (Jurusan)</label>
        <select name="jurusan_id" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; background: white;">
            @foreach($jurusans as $j)
                <option value="{{ $j->id }}" {{ $produk->jurusan_id == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Stok</label>
        <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label>Ganti Gambar (Opsional)</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>

    <button type="submit" style="width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Simpan Perubahan</button>
</form>

        <a href="/dashboard" class="back-link">&larr; Kembali ke Dashboard</a>
    </div>

</body>
</html>