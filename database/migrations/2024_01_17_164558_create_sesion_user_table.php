<?php

use App\Models\Sesion;
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
        Schema::create('sesion_user', function (Blueprint $table) {
            $table->id();
            $table->string('estado')->default(Sesion::ESPERA);
            $table->timestamp('fecha_invitacion');
            $table->timestamp('fecha_respuesta')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('sesion_id')->references('id')->on('sesions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_user');
    }
};
