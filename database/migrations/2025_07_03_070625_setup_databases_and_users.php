<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Catatan: Menjalankan DDL (seperti CREATE DATABASE/USER) di dalam migrasi
     * adalah praktik yang tidak umum dan memerlukan hak akses tinggi
     * pada koneksi database default Anda (misalnya, user 'root').
     */
    public function up(): void
    {

    }

    /**
     * Reverse the migrations.
     *
     * Metode 'down' ini akan menghapus database dan user
     * jika Anda menjalankan 'php artisan migrate:rollback'.
     */
    public function down(): void
    {

    }
};
