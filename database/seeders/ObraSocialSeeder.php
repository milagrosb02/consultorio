<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObraSociale;

class ObraSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ObraSociale::create([
            'obra_social' => 'IPS'
        ]);

        ObraSociale::create([
            'obra_social' => 'MEDIFÉ'
        ]);

        ObraSociale::create([
            'obra_social' => 'PARTICULAR'
        ]);

        ObraSociale::create([
            'obra_social' => 'OSDE'
        ]);

        ObraSociale::create([
            'obra_social' => 'OSECAC'
        ]);




    }


}
