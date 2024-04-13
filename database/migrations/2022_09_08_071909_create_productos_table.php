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
            $table->unsignedBigInteger('pasillo_idPasillo')->nullable();
            $table->unsignedBigInteger('estante_idEstante')->nullable();
            $table->unsignedBigInteger('mesa_idMesa')->nullable();
            $table->unsignedBigInteger('categoria_idCategoria')->nullable();
            $table->unsignedBigInteger('subcategoria_idSubcategoria')->nullable();

            $table->foreign('unidad_idUnidad')
            ->references('id')->on('unidads')->onDelete('set null');
            $table->foreign('grupo_idGrupo')
            ->references('id')->on('grupos')->onDelete('set null');
            $table->foreign('cuenta_idCuenta')
            ->references('id')->on('cuentas')->onDelete('set null');
            $table->foreign('pasillo_idPasillo')
            ->references('id')->on('pasillos')->onDelete('set null');
            $table->foreign('estante_idEstante')
            ->references('id')->on('estantes')->onDelete('set null');
            $table->foreign('mesa_idMesa')
            ->references('id')->on('mesas')->onDelete('set null');
            $table->foreign('categoria_idCategoria')
            ->references('id')->on('categorias')->onDelete('set null');
            $table->foreign('subcategoria_idSubcategoria')
            ->references('id')->on('subcategorias')->onDelete('set null');

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
