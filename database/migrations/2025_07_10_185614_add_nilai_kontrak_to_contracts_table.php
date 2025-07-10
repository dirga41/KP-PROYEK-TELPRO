<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menggunakan Schema::table() untuk memodifikasi tabel yang sudah ada
        Schema::table('contracts', function (Blueprint $table) {
            /**
             * Menambahkan kolom 'nilai_kontrak'.
             * - Tipe: decimal, untuk menyimpan nilai uang dengan presisi.
             * - Parameter: 15 digit total, 2 digit di belakang koma.
             * - default(0): Jika tidak diisi, nilainya akan menjadi 0.
             * - after('status'): Meletakkan kolom ini setelah kolom 'status' agar rapi.
             */
            $table->decimal('nilai_kontrak', 15, 2)->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Logika untuk membatalkan migrasi (jika diperlukan)
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('nilai_kontrak');
        });
    }
};
