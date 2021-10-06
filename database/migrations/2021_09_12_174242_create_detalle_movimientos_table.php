<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_movimientos', function (Blueprint $table) {
            $table->id();
            $table->integer("cantidad")->nullable();
            $table->double("valor_total")->nullable();

            $table->unsignedBigInteger("movimiento_id");
            $table->foreign("movimiento_id")
                ->references("id")->on("movimientos")
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger("producto_id")->nullable();;
            $table->foreign("producto_id")
                ->references("id")->on("productos")
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('detalle_movimientos');
    }
}
