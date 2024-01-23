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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->json('diagrama');
            $table->string('url');
            $table->string('tipo');//XMI=Archivo XMI, J=Java, P=Php, JS=Javascript
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('pizarra_id')->references('id')->on('pizarras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
