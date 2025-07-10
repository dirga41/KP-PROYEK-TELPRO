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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_name');
            $table->string('tenant_group')->nullable();
            $table->string('area');
            $table->string('segment');
            $table->string('portfolio');
            $table->year('tahun_kontrak');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['aktif', 'akan berakhir', 'berakhir']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
