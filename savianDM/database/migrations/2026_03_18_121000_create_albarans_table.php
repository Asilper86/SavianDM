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
        Schema::create('albarans', function (Blueprint $table) {
            $table->id();
            
            // Mantenemos la cascada en la Empresa
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            
            // CAMBIAMOS ESTA LÍNEA A 'no action' o 'restrict'
            $table->foreignId('centro_trabajo_id')
                ->constrained('centro_trabajos')
                ->onDelete('no action'); // <--- IMPORTANTE PARA AZURE/SQL SERVER
            
            $table->enum('estado', ['pendiente', 'entregado', 'retirado', 'enviado'])->default('pendiente');
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // En SQL Server/Azure es vital desactivar las llaves antes de borrar
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('albarans');
        
        Schema::enableForeignKeyConstraints();
    }
};