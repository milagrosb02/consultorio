<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turno;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Turno::create([
            'paciente_id' => 1,
            'user_id' => 2,
            'especialidad_id' => 1,
            'fecha' => '2023-07-31',
            'hora' => '08:00'
        ]);


        Turno::create([
            'paciente_id' => 2,
            'user_id' => 2,
            'especialidad_id' => 1,
            'fecha' => '2023-07-31',
            'hora' => '08:30'
        ]);

        Turno::create([
            'paciente_id' => 3,
            'user_id' => 2,
            'especialidad_id' => 1,
            'fecha' => '2023-07-31',
            'hora' => '09:00'
        ]);

        Turno::create([
            'paciente_id' => 4,
            'user_id' => 3,
            'especialidad_id' => 1,
            'fecha' => '2023-07-31',
            'hora' => '09:30'
        ]);

        Turno::create([
            'paciente_id' => 5,
            'user_id' => 3,
            'motivo_consulta' => "Cambio de muela",
            'fecha' => '2023-07-31',
            'hora' => '10:00'
        ]);


        Turno::create([
            'paciente_id' => 6,
            'user_id' => 3,
            'motivo_consulta' => "Dolor de muela",
            'fecha' => '2023-07-31',
            'hora' => '10:30'
        ]);

        Turno::create([
            'paciente_id' => 7,
            'user_id' => 2,
            'motivo_consulta' => "Carie",
            'fecha' => '2023-07-31',
            'hora' => '11:00'
        ]);

        Turno::create([
            'paciente_id' => 8,
            'user_id' => 2,
            'especialidad_id' => 1,
            'fecha' => '2023-07-31',
            'hora' => '11:30'
        ]);

        Turno::create([
            'paciente_id' => 9,
            'user_id' => 2,
            'especialidad_id' => 2,
            'fecha' => '2023-07-31',
            'hora' => '12:00'
        ]);

        Turno::create([
            'paciente_id' => 10,
            'user_id' => 3,
            'especialidad_id' => 1,
            'fecha' => '2023-07-31',
            'hora' => '11:00'
        ]);

        Turno::create([
            'paciente_id' => 11,
            'user_id' => 2,
            'motivo_consulta' => "Cambio de muela 2",
            'fecha' => '2023-08-02',
            'hora' => '09:00'
        ]);

        Turno::create([
            'paciente_id' => 12,
            'user_id' => 2,
            'especialidad_id' => 1,
            'fecha' => '2023-07-25',
            'hora' => '09:00'
        ]);

        Turno::create([
            'paciente_id' => 13,
            'user_id' => 2,
            'motivo_consulta' => "Arreglo de diente molar",
            'fecha' => '2023-07-25',
            'hora' => '10:00'
        ]);

        Turno::create([
            'paciente_id' => 14,
            'user_id' => 2,
            'motivo_consulta' => "Limpieza profunda",
            'fecha' => '2023-07-25',
            'hora' => '11:30'
        ]);

        Turno::create([
            'paciente_id' => 15,
            'user_id' => 3,
            'motivo_consulta' => "Placa de ortodoncia",
            'fecha' => '2023-07-25',
            'hora' => '09:00'
        ]);

        Turno::create([
            'paciente_id' => 16,
            'user_id' => 3,
            'especialidad_id' => 1,
            'fecha' => '2023-07-25',
            'hora' => '09:30'
        ]);

        Turno::create([
            'paciente_id' => 17,
            'user_id' => 3,
            'motivo_consulta' => "Extraccion de muela del juicio",
            'fecha' => '2023-07-25',
            'hora' => '10:00'
        ]);

    }
}
