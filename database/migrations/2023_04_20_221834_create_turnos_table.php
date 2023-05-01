<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            
            // hago relacion con la doctora
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users'); 

            // hago relacion con especialidades
            $table->unsignedBigInteger('especialidad_id')->nullable()->constrained();
            $table->foreign('especialidad_id')->references('id')->on('especialidades'); 

            $table->string('motivo_consulta')->nullable();

             $table->date('fecha');

             $table->time('hora');

            // hago relacion con pacientes
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');


             // hago uso de soft delete
             $table->softDeletes();

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
        Schema::dropIfExists('turnos');
    }
}
