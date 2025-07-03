<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan otentikasi menggunakan Guards.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
            'login_type' => ['required', 'in:marketing,project'],
        ]);

        // Tentukan guard mana yang akan digunakan berdasarkan input form
        $guardName = $request->input('login_type');

        // Coba login menggunakan guard yang spesifik. Ini adalah perubahan kuncinya.
        if (Auth::guard($guardName)->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Tidak perlu lagi menyimpan 'login_type' di session.
            
            // Redirect langsung ke route dashboard.
            return redirect()->route('dashboard');
        }

        // Jika otentikasi gagal
        return back()->with('error', 'Login Gagal! Username atau Password tidak cocok.')
                     ->withInput($request->only('username', 'login_type'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Logout dari semua guard yang mungkin aktif untuk keamanan.
        Auth::guard('web')->logout();
        Auth::guard('marketing')->logout();
        Auth::guard('project')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
