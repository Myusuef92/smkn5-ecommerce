<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Banner - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page">

    <div class="form-card" style="max-width: 450px; width: 100%;">
        <h2>Tambah Banner Baru</h2>
        <p style="font-size: 12px; color: #64748b; margin-bottom: 20px;">Unggah gambar banner promosi untuk halaman utama.</p>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 4px; font-size: 12px; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- PERHATIKAN: enctype="multipart/form-data" WAJIB ADA untuk upload gambar -->
        <form action="/dashboard/banner/simpan" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Judul Banner (Opsional)</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Contoh: Pameran Produk Teaching Factory" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Pilih Gambar Banner</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required style="font-size: 12px; width: 100%;">
                <small style="font-size: 11px; color: #64748b;">Format: JPG, PNG. Maksimal 2MB.</small>
            </div>

            <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Simpan Banner</button>
        </form>

        <div style="text-align: center; margin-top: 15px;">
            <a href="/dashboard/banner" class="back-link" style="font-size: 12px; color: #2563eb; text-decoration: none;">&larr; Kembali ke Kelola Banner</a>
        </div>
    </div>

</body>
</html>