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
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // ID único para cada evento
            $table->string('name'); // Nombre del evento
            $table->text('description')->nullable(); // Descripción del evento
            $table->date('date'); // Fecha del evento
            $table->string('location'); // Ubicación del evento
            $table->decimal('price', 8, 2)->default(0); // Precio del evento
            $table->timestamps(); // Timestamps para created_at y updated_at
            $table->text('custom_description')->nullable()->after('description');
            $table->string('banner')->nullable()->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('custom_description');
            $table->dropColumn(['logo', 'banner']);
        });
    }
};
