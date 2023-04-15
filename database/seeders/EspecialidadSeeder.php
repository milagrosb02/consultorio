<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         Especialidad::create(['especialidad' => 'Protesis']);

         Especialidad::create(['especialidad' => 'Implantes']);

         Especialidad::create(['especialidad' => 'Ortodoncia']);

        
    }
}
