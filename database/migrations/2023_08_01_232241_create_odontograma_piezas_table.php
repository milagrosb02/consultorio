<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdontogramaPiezasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontograma_piezas', function (Blueprint $table) {
            // hago relacion con pieza
            $table->unsignedBigInteger('pieza_id')->constrained();
            $table->foreign('pieza_id')->references('id')->on('piezas');

            // hago relacion con pieza
            $table->unsignedBigInteger('odontograma_id')->constrained();
            $table->foreign('odontograma_id')->references('id')->on('odontogramas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odontograma_piezas');
    }
}
