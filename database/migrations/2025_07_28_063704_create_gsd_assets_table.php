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
        Schema::create('gsd_assets', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment
            $table->string('nama_gedung'); // Kolom untuk Nama Gedung
            $table->string('alamat_gedung'); // Kolom untuk Alamat
            $table->string('lantai_gedung'); // Kolom untuk Lantai
            $table->decimal('luasan_tersedia', 10, 2)->default(0); // Luas dalam meter persegi, presisi 2 desimal
            $table->string('customer')->nullable(); // Nama customer, boleh kosong
            $table->decimal('luasan_terpakai', 10, 2)->default(0);
            $table->decimal('luasan_idle', 10, 2)->default(0);
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gsd_assets');
    }
};