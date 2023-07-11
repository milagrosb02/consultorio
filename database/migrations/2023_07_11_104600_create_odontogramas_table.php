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

             // hago relacion con pieza
             $table->unsignedBigInteger('pieza_id')->constrained();
             $table->foreign('pieza_id')->references('id')->on('piezas');

              // hago relacion con el tratamiento
            $table->unsignedBigInteger('tratamiento_id')->nullable()->constrained();
            $table->foreign('tratamiento_id')->references('id')->on('tratamientos');

            $table->string('diagnostico');

            // hago relacion con los colores
            $table->unsignedBigInteger('anomalia_color_id')->constrained();
            $table->foreign('anomalia_color_id')->references('id')->on('anomalias_colores');

            // hago relacion con historial clinico
            $table->unsignedBigInteger('legajo_id')->constrained();
            $table->foreign('legajo_id')->references('id')->on('legajos');

           
            
            // hago relacion con caras dentales
            $table->unsignedBigInteger('cara_odontograma_id')->constrained();
            $table->foreign('cara_odontograma_id')->references('id')->on('caras_odontograma');
 

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
