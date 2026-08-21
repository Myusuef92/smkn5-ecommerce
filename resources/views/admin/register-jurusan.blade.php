<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Akun Jurusan - Admin Pusat</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="form-card">
        <h2>Registrasi Akun Pengelola Jurusan</h2>
        <p style="font-size: 12px; color: #64748b; margin-bottom: 15px;">Admin dapat membuat akun login baru untuk masing-masing jurusan.</p>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.store-jurusan') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Pengelola / Jurusan</label>
                <input type="text" name="name" class="form-control" required placeholder="Contoh: Admin RPL">
            </div>

            <div class="form-group">
                <label>Email Login</label>
                <input type="email" name="email" class="form-control" required placeholder="rpl@smkn5tangerang.sch.id">
            </div>

            <div class="form-group">
                <label>Pilih Konsentrasi Keahlian (Jurusan)</label>
                <select name="jurusan_id" class="form-control" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach(\App\Models\Jurusan::all() as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-submit">Buat Akun Jurusan</button>
        </form>

        <a href="/dashboard" class="back-link">&larr; Kembali ke Dashboard Admin</a>
    </div>

</body>
</html>