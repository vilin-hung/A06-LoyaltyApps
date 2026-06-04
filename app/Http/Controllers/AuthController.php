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
            // Regenerasi ID session untuk mencegah Session Fixation
            $request->session()->regenerate();

            // Cek role, redirect sesuai role
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Redirect intended 
            return redirect()->intended(route('home'));
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // Logika signup
    public function signup(Request $request)
    {
        // Validasi data signup
        $validatedData = $request->validate([
            'name' => 'required|string|max:80',
            'email' => 'required|email|unique:users',
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed',
            ], 
        ]);

        // Email huruf kecil untuk konsistensi
        $email = strtolower($validatedData['email']);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $email,
            'password' => Hash::make($validatedData['password']),
            'saldo' => 0,
            'points' => 0,
            'role' => 'user', //default
        ]);

        // Auto login setelah daftar
        Auth::login($user);
        
        // Regenerasi session setelah login
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat');
    }
    
    // Logika logout 
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Invalidate session dan regenerate token 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}