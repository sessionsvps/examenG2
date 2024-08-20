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
        Schema::create('detalle_cabeceras', function (Blueprint $table) {
            $table->unsignedBigInteger('id_alquiler');
            $table->unsignedBigInteger('id_video');
            $table->float('precio');
            $table->integer('cantidad');
            // LLAVE PRIMARIA COMPUESTA
            $table->primary(['id_alquiler', 'id_video']);
            // FK
            $table->foreign('id_alquiler')->references('id')->on('cabecera_alquileres');
            $table->foreign('id_video')->references('id')->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_cabeceras');
    }
};
