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
            $table->timestamp("fecha");
            $table->enum("estado", [
                1, // Borrador
                2, // Finalizado
            ]);
            $table->unsignedBigInteger("documento_id");
            $table->foreign("documento_id")
                ->references("id")->on("documentos")
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger("sucursale_id")->nullable();;
            $table->foreign("sucursale_id")
                ->references("id")->on("sucursales")
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->string("user_id", 10)->nullable();
            //$table->unsignedBigInteger("user_id")->nullable();;
            $table->foreign("user_id")
                ->references("id")->on("users")
                ->onUpdate('cascade')
                ->onDelete('set null');

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
