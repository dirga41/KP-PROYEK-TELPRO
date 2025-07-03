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
        // Ganti password di bawah ini dengan password yang Anda inginkan
        $marketingPassword = 'Marketing123';
        $projectPassword = 'Project123';

        // Menggunakan koneksi default (harus memiliki hak akses tinggi)
        // untuk membuat database dan user baru.

        // --- SETUP MARKETING ---
        DB::statement("CREATE DATABASE IF NOT EXISTS db_marketing");
        // FIX: Membangun string SQL secara langsung karena parameter binding tidak didukung untuk CREATE USER
        DB::statement("CREATE USER IF NOT EXISTS 'user_db_marketing'@'localhost' IDENTIFIED BY '$marketingPassword'");
        DB::statement("GRANT ALL PRIVILEGES ON db_marketing.* TO 'user_db_marketing'@'localhost'");

        // --- SETUP PROJECT ---
        DB::statement("CREATE DATABASE IF NOT EXISTS db_project");
        // FIX: Membangun string SQL secara langsung
        DB::statement("CREATE USER IF NOT EXISTS 'user_db_project'@'localhost' IDENTIFIED BY '$projectPassword'");
        DB::statement("GRANT ALL PRIVILEGES ON db_project.* TO 'user_db_project'@'localhost'");

        DB::statement("FLUSH PRIVILEGES");
    }

    /**
     * Reverse the migrations.
     *
     * Metode 'down' ini akan menghapus database dan user
     * jika Anda menjalankan 'php artisan migrate:rollback'.
     */
    public function down(): void
    {
        // Perintah DROP USER mungkin memerlukan hak akses yang lebih spesifik
        DB::statement("DROP DATABASE IF EXISTS db_marketing");
        DB::statement("DROP USER IF EXISTS 'user_db_marketing'@'localhost'");

        DB::statement("DROP DATABASE IF EXISTS db_project");
        DB::statement("DROP USER IF EXISTS 'user_db_project'@'localhost'");
    }
};
