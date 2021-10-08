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
            $table->string('id', 20)->unique();
            $table->primary('id');
            $table->enum("tipo_documento", [
                "NIT", // NIT Empresa
                "CC", // Cédula de ciudadanía
                "TI", // Tarjeta deidentidad
                "TP", // Tarjeta de pasaporte
                "RC", // Registro civil 
                "CE", // Cédula de extranjería 
                "DNI", // Documento nacional de identidad
            ]);
            $table->string('nombre', 45);
            $table->string("apellido", 45);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("telefono", 20);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->enum("estado_usuario", [
                "Activo",
                "Inactivo"
            ]);
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
