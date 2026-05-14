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
            $table->string('lugar')->nullable()->after('centro_trabajo_id');
            $table->date('fecha')->nullable()->after('lugar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albarans', function (Blueprint $table) {
            $table->dropColumn(['lugar', 'fecha']);
        });
    }
};
