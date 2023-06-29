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
        AnomaliaColor::create(['color' => 'Rojo']);

        AnomaliaColor::create(['color' => 'Azul']);

        AnomaliaColor::create(['color' => 'Verde']);

        AnomaliaColor::create(['color' => 'Amarillo']);

        AnomaliaColor::create(['color' => 'Negro']);

    }
}
