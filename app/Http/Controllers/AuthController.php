<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan halaman daftar akun
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Logika login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role, redirect sesuai role
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika user berhasil login langsung lempar ke halaman utama 
            return redirect()->intended('/');
        }

        // Jika error
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // Logika signup
    public function signup(Request $request)
    {
        // Validasi Data
        $validatedData = $request->validate([
            'name' => 'required|string|max:80',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
        ]);

        // Buat user baru 
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'saldo' => 0,          // Default saldo awal Rp 0
            'points' => 0,         // Default poin awal 0
            'role' => 'user',      // Otomatis terdaftar sebagai user 
        ]);

        // Setelah berhasil daftar, otomatis login
        Auth::login($user);

        return redirect()->route('home');
    }
    
    // Logika logout 
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Bersihkan session agar aman
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}