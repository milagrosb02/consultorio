<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paciente::create([

            'user_id'=> 4,
            'phone' => '3764112581',
            'obra_social_id' => 1

        ]);

        Paciente::create([

            'user_id'=> 5,
            'phone' => '3764112518',
            'obra_social_id' => 1

        ]);

        Paciente::create([

            'user_id'=> 6,
            'phone' => '37641125112',
            'obra_social_id' => 2

        ]);

        Paciente::create([

            'user_id'=> 7,
            'phone' => '3764112566',
            'obra_social_id' => 1

        ]);

        Paciente::create([

            'user_id'=> 8,
            'phone' => '3764112533',
            'obra_social_id' => 2

        ]);

        Paciente::create([

            'user_id'=> 9,
            'phone' => '3764112599',
            'obra_social_id' => 1

        ]);

        Paciente::create([

            'user_id'=> 10,
            'phone' => '3764112544',
            'obra_social_id' => 2

        ]);

        Paciente::create([

            'user_id'=> 11,
            'phone' => '3764112522',
            'obra_social_id' => 2

        ]);

        Paciente::create([

            'user_id'=> 12,
            'phone' => '3764112545',
            'obra_social_id' => 2

        ]);

        Paciente::create([

            'user_id'=> 13,
            'phone' => '3764112598',
            'obra_social_id' => 1

        ]);

        Paciente::create([

            'user_id'=> 14,
            'phone' => '3764112577',
            'obra_social_id' => 1

        ]);

        Paciente::create([

            'user_id'=> 15,
            'phone' => '3764998877',
            'obra_social_id' => 2

        ]);

        Paciente::create([

            'user_id'=> 16,
            'phone' => '3764111134',
            'obra_social_id' => 3

        ]);

        Paciente::create([

            'user_id'=> 17,
            'phone' => '37641109998',
            'obra_social_id' => 3

        ]);

        Paciente::create([

            'user_id'=> 18,
            'phone' => '3764134567',
            'obra_social_id' => 3

        ]);

        Paciente::create([

            'user_id'=> 19,
            'phone' => '3764198866',
            'obra_social_id' => 4

        ]);

        Paciente::create([

            'user_id'=> 20,
            'phone' => '376411112233',
            'obra_social_id' => 4

        ]);
    }
}
