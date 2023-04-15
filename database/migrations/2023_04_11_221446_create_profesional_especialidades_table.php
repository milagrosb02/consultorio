<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesionalEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesional_especialidades', function (Blueprint $table) {
           // $table->id();

            // hago relacion con usuarios (rol 2)
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');


            // hago relacion con especialidades
            $table->unsignedBigInteger('especialidad_id');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesional_especialidades');
    }
}
