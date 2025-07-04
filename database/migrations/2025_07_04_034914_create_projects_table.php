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
        // Membuat tabel baru bernama 'projects' dengan skema yang diperbarui
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment (primary key)
            $table->string('segment'); // Kolom untuk Segment
            $table->string('area'); // Kolom untuk Area
            $table->string('project'); // Kolom untuk Nama Project
            $table->string('no_kontrak')->unique(); // Kolom untuk Nomor Kontrak, harus unik
            $table->date('tanggal_kontrak'); // Kolom untuk Tanggal Kontrak
            $table->decimal('nilai_kontrak', 15, 2); // Kolom untuk Nilai Kontrak (angka dengan desimal)
            $table->date('toc')->nullable(); // Kolom untuk tanggal TOC (opsional)
            
            // Kolom untuk Status Progres dengan pilihan yang ditentukan
            $table->enum('status_progres', ['ongoing', 'closed', 'closed adm', 'not started'])->default('not started');
            
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at' otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Perintah untuk menghapus tabel jika migrasi di-rollback
        Schema::dropIfExists('projects');
    }
};
