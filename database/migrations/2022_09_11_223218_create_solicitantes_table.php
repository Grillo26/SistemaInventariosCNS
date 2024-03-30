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
        Schema::create('solicitantes', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->string('detalle');
            $table->string('cantidad');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('producto_idProducto')->nullable();
            $table->unsignedBigInteger('estado_idEstado')->nullable();

            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('set null');
            $table->foreign('estado_idEstado')
            ->references('id')->on('estados')->onDelete('set null');
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
        Schema::dropIfExists('solicitantes');
    }
};
