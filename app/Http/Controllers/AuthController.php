<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // 1. Memproses Data Login
    public function login(Request $request)
    {
        // Validasi inputan form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba melakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika berhasil, arahkan ke dashboard
            return redirect('/dashboard');
        }

        // Jika gagal, kembalikan ke halaman utama dengan pesan error
        return redirect('/')->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    // 2. Menampilkan Halaman Register
    public function showRegisterForm()
    {
        $jurusans = Jurusan::all();
        return view('auth.register', compact('jurusans'));
    }

    // 3. Memproses Data Pendaftaran (Register)
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengelola_jurusan', // Default sebagai pengelola jurusan
            'jurusan_id' => $request->jurusan_id,
        ]);

        // Langsung login otomatis setelah daftar berhasil
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Akun berhasil didaftarkan!');
    }

    // 4. Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout, arahkan kembali ke halaman utama (welcome)
        return redirect('/');
    }
}