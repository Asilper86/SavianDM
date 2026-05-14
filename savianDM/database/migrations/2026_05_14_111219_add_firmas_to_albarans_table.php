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
            $table->longText('firma_trabajador')->nullable()->after('descripcion');
            $table->longText('firma_cliente')->nullable()->after('firma_trabajador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albarans', function (Blueprint $table) {
            $table->dropColumn(['firma_trabajador', 'firma_cliente']);
        });
    }
};
