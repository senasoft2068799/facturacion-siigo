<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            /*$table->string('id', 10)->unique();
            $table->primary('id');
            $table->enum("tipo_documento", [
                "NIT", // NIT Empresa
                "CC", // Cedula ciudadanía
                "TI", // Tarjeta identidad
                "TP", // Tarjeta pasaporte
                "RC", // Registro civil
                "CE", // Cedula extrangería 
                "DNI", // Documento nacional de identidad
            ]);
            $table->string('nombre', 45);
            $table->string("apellido", 45);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("telefono", 20);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();*/
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
