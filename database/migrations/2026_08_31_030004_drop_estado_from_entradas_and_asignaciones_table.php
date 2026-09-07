<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('asignaciones', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }

    public function down(): void
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('pendiente')->after('cantidad');
        });

        Schema::table('asignaciones', function (Blueprint $table) {
            $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('pendiente')->after('cantidad');
        });
    }
};
