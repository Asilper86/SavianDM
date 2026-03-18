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
            $table->id('codigo');
            $table->enum('tipoCompra' , ['Propio' , 'Alquilado']);
            $table->enum('estado' , ['Bien' , 'Roto']);
            $table->foreignId('modelo_id')->constrained()->cascadeOnDelete();
            $table->foreignId('empresa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('proveedor_id')->constrained()->cascadeOnDelete();
            $table->text('comentario')->nullable();
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
