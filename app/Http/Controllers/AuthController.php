<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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
     * Menangani permintaan otentikasi.
     */
    public function authenticate(Request $request)
    {
        // 1. Validasi input dasar
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
            'login_type' => ['required', 'in:marketing,project'],
        ]);

        // 2. Tentukan koneksi database
        $connection = 'mysql_' . $request->input('login_type');
        
        // 3. Set koneksi database secara dinamis
        Config::set('database.default', $connection);
        DB::purge($connection);

        // 4. Lakukan percobaan login
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // --- TAMBAHKAN BARIS INI ---
            // Simpan tipe login ke dalam session agar bisa digunakan di seluruh aplikasi.
            $request->session()->put('login_type', $request->input('login_type'));

            // Redirect ke dashboard
            return redirect()->intended('dashboard');
        }

        // 5. Jika otentikasi gagal
        return back()->with('error', 'Login Gagal! Username atau Password tidak cocok pada database yang dipilih.')
                     ->withInput($request->only('username', 'login_type'));
    }
}
