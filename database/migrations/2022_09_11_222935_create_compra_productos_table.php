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
        Schema::create('compra_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_idProducto')->nullable();
            $table->unsignedBigInteger('proveedor_idProveedor')->nullable();
            $table->string('descripcion');
            $table->date('fecha_adquisicion');
            $table->unsignedBigInteger('pasillo_idPasillo')->nullable();
            $table->unsignedBigInteger('estante_idEstante')->nullable();
            $table->unsignedBigInteger('mesa_idMesa')->nullable();
            $table->date('fecha_caducidad');
            $table->integer('cantidad');
            $table->integer('cantidad_db');
            $table->decimal('valor_articulo',8,3);
            $table->decimal('total',8,3);

            $table->foreign('producto_idProducto')
            ->references('id')->on('productos')->onDelete('set null');

            $table->foreign('proveedor_idProveedor')
            ->references('id')->on('proveedors')->onDelete('set null');
            $table->foreign('pasillo_idPasillo')
            ->references('id')->on('pasillos')->onDelete('set null');
            $table->foreign('estante_idEstante')
            ->references('id')->on('estantes')->onDelete('set null');
            $table->foreign('mesa_idMesa')
            ->references('id')->on('mesas')->onDelete('set null');



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
