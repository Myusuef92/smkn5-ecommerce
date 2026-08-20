<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Akun Jurusan - Admin Pusat</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .form-card { background: white; width: 100%; max-width: 450px; padding: 30px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h2 { font-size: 16px; color: #1e293b; margin-bottom: 20px; font-weight: 800; text-transform: uppercase; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 5px; }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 13px; outline: none; }
        .form-control:focus { border-color: #e60012; }
        .btn-submit { background: #0f172a; color: white; border: none; padding: 10px; border-radius: 4px; font-size: 13px; font-weight: 700; cursor: pointer; width: 100%; }
        .btn-submit:hover { background: #1e293b; }
        .back-link { display: block; text-align: center; margin-top: 15px; font-size: 12px; color: #64748b; text-decoration: none; }
        .back-link:hover { color: #e60012; }
        .alert-success { background: #f0fdf4; color: #16a34a; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 12px; }
    </style>
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