<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('n_comprobante');
            $table->string('detalle');
            $table->unsignedBigInteger('entrada_idEntrada')->nullable();
            $table->unsignedBigInteger('salida_idSalida')->nullable();

            $table->foreign('entrada_idEntrada')->references('id')->on('entradas')->onDelete('set null'); 
            $table->foreign('salida_idSalida')->references('id')->on('salidas')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobantes');
    }
}
