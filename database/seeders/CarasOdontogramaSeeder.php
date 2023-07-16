<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaraOdontograma;

class CarasOdontogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // CREO LAS CARAS DEL ODONTO
         CaraOdontograma::create(['nombre' => 'Vestibular']);

         CaraOdontograma::create(['nombre' => 'Palatino']);

         CaraOdontograma::create(['nombre' => 'Mesial']);

         CaraOdontograma::create(['nombre' => 'Distal']);

         CaraOdontograma::create(['nombre' => 'Oclusal']);
    }
}
