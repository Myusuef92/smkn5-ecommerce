<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page">

    <div class="form-card" style="max-width: 500px; width: 100%;">
        <h2>Tambah Produk Unggulan</h2>
        <p style="font-size: 12px; color: #64748b; margin-bottom: 20px;">Masukkan data produk karya siswa Teaching Factory.</p>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 4px; font-size: 12px; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/tambah-produk" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group" style="margin-bottom: 15px;">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
    </div>

    <!-- Dropdown Jurusan Hanya Tampil Jika yang Login Admin -->
    @if(Auth::user()->role === 'admin')
        <div class="form-group" style="margin-bottom: 15px;">
            <label>Kompetensi Keahlian (Jurusan)</label>
            <select name="jurusan_id" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; background: white;">
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusans as $j)
                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Harga (Rp)</label>
        <input type="number" name="harga" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;"></textarea>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label>Foto Produk</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>

    <button type="submit" style="width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Simpan Produk</button>
</form>
        <div style="text-align: center; margin-top: 15px;">
            <a href="/dashboard" class="back-link" style="font-size: 12px; color: #2563eb; text-decoration: none;">&larr; Kembali ke Dashboard</a>
        </div>
    </div>

</body>
</html>