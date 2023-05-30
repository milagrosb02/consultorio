<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HorarioAtencion;

class HorariosAtencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    // cantidad maxima permitida de pacientes en ese horario o turno 
    {
        $horarios = [
            [
                'dia'=>'Lunes',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 2
            
            ],

            [
                'dia'=>'Martes',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 2
            
            ],


            [
                'dia'=>'Miercoles',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 2
            
            ],


            [
                'dia'=>'Jueves',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 2
            
            ],


            [
                'dia'=>'Viernes',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 2
            
            ],


            [
                'dia'=>'Lunes',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 3
            
            ],


            [
                'dia'=>'Martes',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 3
            
            ],


            [
                'dia'=>'Miercoles',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 3
            
            ],

            [
                'dia'=>'Jueves',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 3
            
            ],


            [
                'dia'=>'Viernes',
                'hora_desde'=>'08:00',
                'hora_hasta'=>'12:00',
                'user_id'=> 3
            
            ],

        ];


        foreach ($horarios as $horario) {
            HorarioAtencion::create($horario);
        }
    }
}
