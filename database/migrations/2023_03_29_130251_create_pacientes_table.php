<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
             
            $table->id();
            
             //haciendo relacion con users
             $table->unsignedBigInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users');

            $table->string('phone')->unique();


            // haciendo relacion con obra social
            $table->unsignedBigInteger('obra_social_id');
            $table->foreign('obra_social_id')->references('id')->on('obra_sociales');

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
        Schema::dropIfExists('pacientes');
    }
}
