<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
// Menampilkan halaman form register
    public function showRegisterForm()
    {
        $jurusans = \App\Models\Jurusan::all();
        return view('auth.register', compact('jurusans'));
    }

    // Memproses data pendaftaran akun baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'pengelola_jurusan', // Default daftar sebagai pengelola jurusan
            'jurusan_id' => $request->jurusan_id,
        ]);

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect('/dashboard')->with('success', 'Akun berhasil didaftarkan!');
    }

public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}