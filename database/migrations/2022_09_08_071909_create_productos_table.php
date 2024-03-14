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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_producto')->unique();
            $table->string('nombre_producto');
            $table->unsignedBigInteger('unidad_idUnidad')->nullable();
            $table->unsignedBigInteger('grupo_idGrupo')->nullable();
            $table->unsignedBigInteger('cuenta_idCuenta')->nullable();

            $table->foreign('unidad_idUnidad')
            ->references('id')->on('unidads')->onDelete('set null');
            $table->foreign('grupo_idGrupo')
            ->references('id')->on('grupos')->onDelete('set null');
            $table->foreign('cuenta_idCuenta')
            ->references('id')->on('cuentas')->onDelete('set null');

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
        Schema::dropIfExists('productos');
    }
};
