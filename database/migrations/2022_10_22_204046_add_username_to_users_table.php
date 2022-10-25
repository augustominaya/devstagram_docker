<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        //schema es una clase de larabel
        //Table es una funcion estatica
        //user es la tabla a trabajar
        //Blueprint es el tipo de objeto que permite las migraciones.
        Schema::table('users', function (Blueprint $table) {
            
            //table es el objeto que contine la estructura de la tabla user;
            //string para laravel es el varchar para la base de datos.
            //username es el campo a agregar.
            // agregamos el parametro Unique para evitar duplicados en base de datos
            //Antes = table->dropColumn('username');
            $table->string('username')->unique();

        });
    }
    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
