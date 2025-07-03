<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config; // <-- Tambahkan ini
use Illuminate\Support\Facades\DB;      // <-- Tambahkan ini

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an incoming request.
     *
     * Metode ini di-override untuk memeriksa semua guard dan juga
     * mengatur koneksi database default berdasarkan guard yang aktif.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array<int, string>  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = ['web', 'marketing', 'project'];
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // 1. Set guard ini sebagai default untuk otentikasi
                Auth::shouldUse($guard);

                // 2. Ambil nama koneksi database dari konfigurasi provider guard ini
                $provider = config("auth.guards.{$guard}.provider");
                $connection = config("auth.providers.{$provider}.connection");

                // 3. Jika koneksi ditemukan, set sebagai koneksi default untuk request ini
                if ($connection) {
                    Config::set('database.default', $connection);
                    DB::purge($connection);
                }

                // Keluar dari loop karena pengguna yang terotentikasi sudah ditemukan.
                return;
            }
        }

        // Jika tidak ada pengguna yang ditemukan di guard manapun, lempar exception.
        $this->unauthenticated($request, $guards);
    }
}
