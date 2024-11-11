<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
        // Agregar la columna 'age' a la tabla 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable(); // La columna 'age' será de tipo integer
        });

        // Asignar números aleatorios a los usuarios existentes
        DB::table('users')->update([
            'age' => DB::raw('FLOOR(RANDOM() * 100)')
        ]);
        // Usamos RANDOM() en lugar de RAND() para PostgreSQ
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la columna 'age' en el método down si es necesario revertir la migración
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }
};
