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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('cantidad')->default(0); //Este campo será el que se editará y cambiará
            $table->integer('cantidad_entrada')->default(0);
            $table->integer('cantidad_salida')->default(0);
            $table->unsignedBigInteger('proveedor_idProveedor')->nullable();
            $table->string('obs')->nullable();
            
            $table->timestamps();

            // Llave foránea para relación con la tabla productos
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');

            $table->foreign('proveedor_idProveedor')->references('id')->on('proveedors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
};
