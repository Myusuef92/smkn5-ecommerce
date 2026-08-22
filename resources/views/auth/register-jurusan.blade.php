<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Akun Jurusan - SMKN 5 Kab. Tangerang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="center-page">

    <div class="form-card" style="max-width: 450px; width: 100%;">
        <h2>Buat Akun Pengelola Jurusan</h2>
        <p style="font-size: 12px; color: #64748b; margin-bottom: 20px;">Berikan akun ini kepada perwakilan guru/admin jurusan terkait.</p>

        @if($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 4px; font-size: 12px; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/register-jurusan" method="POST">
            @csrf
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Nama Pengelola / Jurusan</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Admin RPL" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Pilih Kompetensi Keahlian (Jurusan)</label>
                <select name="jurusan_id" class="form-control" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; background: white; box-sizing: border-box;">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusans as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Email Akun</label>
                <input type="email" name="email" class="form-control" placeholder="rpl@smkn5tangerang.sch.id" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size: 12px; font-weight: 600; display: block; margin-bottom: 5px;">Password</label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required style="width: 100%; padding: 10px; padding-right: 40px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box;">
                    <span onclick="togglePassword()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #64748b;">
                        👁️
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Simpan Akun Jurusan</button>
        </form>

        <div style="text-align: center; margin-top: 15px;">
            <a href="/dashboard" class="back-link" style="font-size: 12px; color: #2563eb; text-decoration: none;">&larr; Kembali ke Dashboard</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</body>
</html>