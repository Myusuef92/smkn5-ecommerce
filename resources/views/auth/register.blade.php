<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pengelola Jurusan - SMK Negeri 5 Kab. Tangerang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8fafc; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .card { background: #ffffff; max-width: 450px; width: 100%; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        .header { text-align: center; margin-bottom: 25px; }
        .header h1 { font-size: 20px; color: #1e293b; font-weight: 700; margin-bottom: 5px; }
        .header p { font-size: 13px; color: #64748b; }
        .alert-error { background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 10px; font-size: 13px; border-radius: 6px; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; outline: none; }
        .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        .btn-submit { width: 100%; padding: 10px; background-color: #ea580c; color: #ffffff; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; margin-top: 5px; }
        .btn-submit:hover { background-color: #c2410c; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #64748b; border-top: 1px solid #f1f5f9; padding-top: 15px; }
        .footer a { color: #2563eb; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

    <div class="card">
        <div class="header">
            <h1>SMK Negeri 5 Kab. Tangerang</h1>
            <p>Daftar Akun Pengelola Unit Produksi Jurusan</p>
        </div>

        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap / PIC</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required placeholder="Nama Pengelola">
            </div>

            <div class="form-group">
                <label>Email Resmi Sekolah</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required placeholder="nama@smkn5tangerang.sch.id">
            </div>

            <div class="form-group">
                <label>Pilih Konsentrasi Keahlian / Jurusan</label>
                <select name="jurusan_id" class="form-control" required>
                    <option value="">-- Pilih Jurusan yang Dikelola --</option>
                    @foreach($jurusans as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn-submit">Daftarkan Akun</button>
        </form>

        <div class="footer">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

</body>
</html>