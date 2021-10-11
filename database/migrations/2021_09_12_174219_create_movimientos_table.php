<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string("descripcion")->nullable();;
            $table->double("valor_total")->nullable();;
            $table->unsignedBigInteger("documento_id");
            $table->foreign("documento_id")
                ->references("id")->on("documentos")
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger("sucursale_id")->nullable();
            $table->foreign("sucursale_id")
                ->references("id")->on("sucursales")
                ->onUpdate('cascade')
                ->onDelete('set null');

            /*$table->string("user_id", 10)->nullable();
            //$table->unsignedBigInteger("user_id")->nullable();*/
            $table->string("user_id", 20)->nullable();
            $table->foreign("user_id")
                ->references("id")->on("users")
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->tinyInteger("estado_factura");
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
        Schema::dropIfExists('movimientos');
    }
}
