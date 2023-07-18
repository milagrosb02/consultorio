<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnomaliaColor;

class AnomaliaColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREO COLORES

        AnomaliaColor::create(['color' => 'Rojo', 'descripcion' => 'Patologia o lesión. ']);

        AnomaliaColor::create(['color' => 'Azul', 'descripcion' => 'Tratamiento que el paciente tiene hecho. ']);

        

    }
}
