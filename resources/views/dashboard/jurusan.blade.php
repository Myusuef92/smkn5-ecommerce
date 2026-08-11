<!DOCTYPE html>
<html>
<head><title>Dashboard Pengelola Jurusan</title></head>
<body>
    <h1>Selamat Datang, Pengelola Jurusan!</h1>
    <p>Di sini Anda dapat menambah dan mengelola produk unggulan dari jurusan Anda.</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>