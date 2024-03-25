<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_idProducto')->nullable();
            $table->date('fecha_salida');
            $table->integer('stock_disponible');
            $table->integer('cantidad_salida');
            $table->integer('cantidad_stockTotal');

            $table->foreign('producto_idProducto')
            ->references('id')->on('productos')->onDelete('set null');



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
        Schema::dropIfExists('salidas');
    }
}
