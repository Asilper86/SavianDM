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
        Schema::create('albaran_materiales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('albaran_id')->constrained()->cascadeOnDelete();
            $table->foreignId('material_id')->nullable()->constrained('materiales')->nullOnDelete();
            $table->integer('cantidad')->default(1);
            $table->string('material_ocasional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albaran_materiales');
    }
};
