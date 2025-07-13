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
        Schema::table('projects', function (Blueprint $table) {
            $table->date('spk_date')->nullable();
            $table->date('leads_date')->nullable();
            $table->date('approval_jib_date')->nullable();
            $table->date('contract_date')->nullable();
            $table->date('procurement_juskeb_date')->nullable();
            $table->date('procurement_rb_date')->nullable();
            $table->date('procurement_juspeng_date')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
