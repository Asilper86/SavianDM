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
        Schema::create('albaran_movil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('albaran_id')->constrained('albarans')->cascadeOnDelete();
            $table->foreignId('movil_id')->constrained('movils')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albaran_movil');
    }
};
