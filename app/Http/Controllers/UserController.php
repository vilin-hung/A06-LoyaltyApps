<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan halaman profil user yang sedang login
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    // Menampilkan halaman ganti password
    public function showChangePassword()
    {
        return view('user.change-password');
    }

    // Logika perubahan password
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        
        // Validasi dengan konfirmasi password baru
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        // Cek password lama sebelum update
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai']);
        }

        // Update password baru dengan hash
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui');
    }

    // Menampilkan poin user
    public function points()
    {
        $user = auth()->user();
        return view('user.points', compact('user'));
    }

    // Menampilkan saldo user
    public function saldo()
    {
        $user = auth()->user();
        return view('user.saldo', compact('user'));
    }
}