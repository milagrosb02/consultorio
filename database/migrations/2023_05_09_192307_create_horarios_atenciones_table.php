<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosAtencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_atenciones', function (Blueprint $table) {
            $table->id();

            $table->string('dia');

            $table->time('hora_desde');

            $table->time('hora_hasta');

             // hago relacion con la doctora
             $table->unsignedBigInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users'); 

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
        Schema::dropIfExists('horarios_atenciones');
    }
}
