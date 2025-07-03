<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SetDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah session 'login_type' ada
        if (session()->has('login_type')) {
            $loginType = session('login_type');
            $connection = 'mysql_' . $loginType;

            // Pastikan koneksi yang diminta ada di file config/database.php
            if (config()->has("database.connections.$connection")) {
                // Set koneksi database default untuk permintaan ini
                Config::set('database.default', $connection);
                
                // Membersihkan koneksi yang ada untuk memastikan koneksi baru dibuat
                DB::purge($connection);
            }
        }

        // Lanjutkan permintaan ke bagian selanjutnya dari aplikasi
        return $next($request);
    }
}
