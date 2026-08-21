<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pengelola Jurusan - SMK Negeri 5 Kab. Tangerang</title>
    
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