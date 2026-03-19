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
        Schema::create('movils', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->enum('tipoCompra' , ['Propio' , 'Alquilado']);
            $table->enum('estado' , ['Bien' , 'Roto']);
            $table->foreignId('modelo_id')->constrained('modelos')->cascadeOnDelete();
            $table->foreignId('empresa_id')->constrained('empresas')->noActionOnDelete();
            $table->foreignId('proveedor_id')->constrained('proveedors')->noActionOnDelete();
            $table->text('comentario')->nullable();
            $table->foreignId('centro_trabajo_id')->constrained('centro_trabajos')->noActionOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movils');
    }
};
