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
        Schema::table('albarans', function (Blueprint $table) {
            $table->string('tipo_trabajo')->nullable()->after('estado');
            $table->text('descripcion')->nullable()->after('tipo_trabajo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albarans', function (Blueprint $table) {
            $table->dropColumn(['tipo_trabajo', 'descripcion']);
        });
    }
};
