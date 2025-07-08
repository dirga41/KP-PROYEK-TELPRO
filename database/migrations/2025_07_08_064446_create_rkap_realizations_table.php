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
        Schema::create('rkap_realizations', function (Blueprint $table) {
            $table->id();
            $table->string('bulan'); // e.g., 'Januari', 'Februari'
            $table->string('periode'); // e.g., 'Q1', 'Q2'
            $table->decimal('rkap_value', 15, 2)->default(0);
            $table->decimal('project_2025_value', 15, 2)->default(0);
            $table->decimal('rev_co_project_2024_sap_value', 15, 2)->default(0);
            $table->decimal('project_2025_co_value', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rkap_realizations');
    }
};
