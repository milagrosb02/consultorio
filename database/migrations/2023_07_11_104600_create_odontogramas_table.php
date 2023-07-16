<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdontogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontogramas', function (Blueprint $table) {

            $table->id();


            // cambio relacion a pacientes
            $table->unsignedBigInteger('paciente_id')->constrained();
            $table->foreign('paciente_id')->references('id')->on('pacientes');
           

             // hago relacion con pieza
             $table->unsignedBigInteger('pieza_id')->constrained();
             $table->foreign('pieza_id')->references('id')->on('piezas');

              // hago relacion con el tratamiento
            $table->unsignedBigInteger('tratamiento_id')->nullable()->constrained();
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos');


            // hago relacion con los colores
            $table->unsignedBigInteger('anomalia_color_id')->constrained();
            $table->foreign('anomalia_color_id')->references('id')->on('anomalias_colores');

            
            // hago relacion con caras dentales
            $table->unsignedBigInteger('cara_odontograma_id')->constrained();
            $table->foreign('cara_odontograma_id')->references('id')->on('caras_odontograma');
            

            $table->string('diagnostico');

            //campo fecha y hora para que se guarden al momento de registrar el dato
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
        Schema::dropIfExists('odontogramas');
    }
}
