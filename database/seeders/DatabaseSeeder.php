<?php

namespace Database\Seeders;

use App\Models\AnomaliaColor;
use App\Models\ObraSociale;
use App\Models\Paciente;
use App\Models\ProfesionalEspecialidade;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        $this->call(AdminSeeder::class);

        $this->call(ProfesionalSeeder::class);

        $this->call(EspecialidadSeeder::class);

        $this->call(ProfesionalEspecialidadSeeder::class);

        $this->call(PiezaSeeder::class);

        $this->call(AnomaliaColorSeeder::class);

        $this->call(HorariosAtencionSeeder::class);

        $this->call(CarasOdontogramaSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(ObraSocialSeeder::class);

        $this->call(PacienteSeeder::class);

        $this->call(TurnoSeeder::class);

       $this->call(TratamientoSeeder::class);
    }
}
