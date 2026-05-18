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
        Schema::table('historials', function (Blueprint $table) {
            $table->string('estado')->nullable()->after('albaran_id');
            $table->foreignId('empresa_id')
                  ->nullable()
                  ->after('estado')
                  ->constrained('empresas')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historials', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropColumn(['estado', 'empresa_id']);
        });
    }
};
