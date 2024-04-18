<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_idProducto')->nullable();
            $table->unsignedBigInteger('proveedor_idProveedor')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha_adquisicion');
            $table->date('fecha_caducidad');
            $table->integer('cantidad');
            $table->decimal('valor_articulo',8,3);
            $table->integer('n_lote');
            $table->string('recep');

            $table->foreign('producto_idProducto')
            ->references('id')->on('productos')->onDelete('set null');
            $table->foreign('proveedor_idProveedor')
            ->references('id')->on('proveedors')->onDelete('set null');


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
        Schema::dropIfExists('compra_productos');
    }
};
