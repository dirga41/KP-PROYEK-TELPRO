<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Menambah kolom 'jenis_pengadaan' setelah 'status_progres'
            $table->string('jenis_pengadaan')->nullable()->after('status_progres');

            // Menambah kolom 'status_panjar' setelah 'jenis_pengadaan'
            $table->string('status_panjar')->nullable()->after('jenis_pengadaan');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['jenis_pengadaan', 'status_panjar']);
        });
    }
};
