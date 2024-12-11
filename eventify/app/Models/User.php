<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ejecutar la migración para agregar claves foráneas.
     *
     * @return void
     */
    public function up(): void
    {
        // Agregar clave foránea 'user_id' a la tabla 'tickets'
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('user_id') // Crear columna 'user_id' como clave foránea
            ->constrained() // Relacionar con la tabla 'users'
            ->onDelete('cascade'); // Eliminar los tickets si el usuario es eliminado
        });

        // Agregar clave foránea 'user_id' a la tabla 'comments'
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('user_id') // Crear columna 'user_id' como clave foránea
            ->constrained() // Relacionar con la tabla 'users'
            ->onDelete('cascade'); // Eliminar los comentarios si el usuario es eliminado
        });
    }

    /**
     * Revertir la migración eliminando las claves foráneas.
     *
     * @return void
     */
    public function down(): void
    {
        // Eliminar clave foránea 'user_id' de la tabla 'tickets'
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Eliminar la relación
            $table->dropColumn('user_id'); // Eliminar la columna
        });

        // Eliminar clave foránea 'user_id' de la tabla 'comments'
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Eliminar la relación
            $table->dropColumn('user_id'); // Eliminar la columna
        });
    }
};
