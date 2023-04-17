<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;
use App\Models\ProfesionalEspecialidade;
use App\Models\User;

class ProfesionalEspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Llamo a los seeders con los que voy a trabajar
      //  $this->call([EspecialidadSeeder::class, ProfesionalSeeder::class]);

        $profesionales = User::whereHas("roles", function($q)
                            {$q->where("name", "profesional");})->get();


        foreach ($profesionales as $profesional) 
        {
            $especialidades = Especialidad::class;

            $profesional->especialidades()->attach($especialidades, []);

        }

    }
}
