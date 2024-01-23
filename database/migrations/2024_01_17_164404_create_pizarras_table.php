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
        Schema::create('pizarras', function (Blueprint $table) {
            $table->id();
            $table->json('diagrama');
            $table->timestamp('fecha_guardado');
            $table->string('imagen_diagrama')->nullable();
            $table->foreignId('sesion_id')->references('id')->on('sesions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizarras');
    }
};
