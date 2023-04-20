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
        // ESPECIALIDADES QUE PERTENECEN A LA PROFESIONAL NUMERO 1
        $profesional1 = User::findOrFail(2);
        $especialidades1 = Especialidad::find([1,2]);
        $profesional1->especialidades()->attach($especialidades1);


        // ESPECIALIDADES QUE PERTENECEN A LA PROFESIONAL NUMERO 2
        $profesional2 = User::findOrFail(3);
        $especialidades2 = Especialidad::find([1,3]);
        $profesional2->especialidades()->attach($especialidades2);
       
    }
}
