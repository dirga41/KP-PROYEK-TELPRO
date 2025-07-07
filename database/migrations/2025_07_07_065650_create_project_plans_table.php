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
        // Membuat tabel baru bernama 'project_plans'
        Schema::create('project_plans', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment
            $table->string('project'); // Kolom untuk Nama Project
            $table->string('user'); // Kolom untuk User/PIC
            $table->string('lokasi'); // Kolom untuk Lokasi
            $table->string('Mitra'); // Kolom untuk Lokasi
            $table->decimal('estimasi_nilai', 15, 2); // Kolom untuk Estimasi Nilai
            $table->text('update_info')->nullable(); // Kolom untuk Update (opsional)
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at' otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_plans');
    }
};
