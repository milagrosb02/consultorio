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

        AnomaliaColor::create(['color' => 'Verde', 'descripcion' => 'Caries radiográficas. ']);

        AnomaliaColor::create(['color' => 'Amarillo', 'descripcion' => 'Sellado de fosas y fisuras. ']);

        AnomaliaColor::create(['color' => 'Negro', 'descripcion' => 'Ausencias naturales. ']);
        

    }
}
