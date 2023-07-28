<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tratamiento;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tratamiento::create([
            'nombre' => 'Limpieza'
        ]);

        Tratamiento::create([
            'nombre' => 'Ortodoncia'
        ]);

        Tratamiento::create([
            'nombre' => 'Obturación'
        ]);

        Tratamiento::create([
            'nombre' => 'Cirugía'
        ]);

        Tratamiento::create([
            'nombre' => 'Sensibilidad'
        ]);

        Tratamiento::create([
            'nombre' => 'Endodoncia'
        ]);

        Tratamiento::create([
            'nombre' => 'Prótesis'
        ]);

        Tratamiento::create([
            'nombre' => 'Implante'
        ]);

    }
}
