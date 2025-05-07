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

        // PACIENTE 1
        Paciente::create([

            'user_id'=> 4,
            'phone' => '3764112581',
            'obra_social_id' => 1

        ]);

        // PACIENTE 2
        Paciente::create([

            'user_id'=> 5,
            'phone' => '3764112518',
            'obra_social_id' => 1

        ]);

        // PACIENTE 3
        Paciente::create([

            'user_id'=> 6,
            'phone' => '37641125112',
            'obra_social_id' => 2

        ]);

        // PACIENTE 4
        Paciente::create([

            'user_id'=> 7,
            'phone' => '3764112566',
            'obra_social_id' => 1

        ]);

        // PACIENTE 5
        Paciente::create([

            'user_id'=> 8,
            'phone' => '3764112533',
            'obra_social_id' => 2

        ]);

        // PACIENTE 6
        Paciente::create([

            'user_id'=> 9,
            'phone' => '3764112599',
            'obra_social_id' => 1

        ]);

        // PACIENTE 7
        Paciente::create([

            'user_id'=> 10,
            'phone' => '3764112544',
            'obra_social_id' => 2

        ]);

        // PACIENTE 8
        Paciente::create([

            'user_id'=> 11,
            'phone' => '3764112522',
            'obra_social_id' => 2

        ]);

        // PACIENTE 9
        Paciente::create([

            'user_id'=> 12,
            'phone' => '3764112545',
            'obra_social_id' => 2

        ]);

        // PACIENTE 10
        Paciente::create([

            'user_id'=> 13,
            'phone' => '3764112598',
            'obra_social_id' => 1

        ]);


        // PACIENTE 11
        Paciente::create([

            'user_id'=> 14,
            'phone' => '3764112577',
            'obra_social_id' => 1

        ]);


        // PACIENTE 12
        Paciente::create([

            'user_id'=> 15,
            'phone' => '3764998877',
            'obra_social_id' => 2

        ]);


        // PACIENTE 13
        Paciente::create([

            'user_id'=> 16,
            'phone' => '3764111134',
            'obra_social_id' => 3

        ]);

        // PACIENTE 14
        Paciente::create([

            'user_id'=> 17,
            'phone' => '37641109998',
            'obra_social_id' => 3

        ]);

        // PACIENTE 15
        Paciente::create([

            'user_id'=> 18,
            'phone' => '3764134567',
            'obra_social_id' => 3

        ]);


        // PACIENTE 16
        Paciente::create([

            'user_id'=> 19,
            'phone' => '3764198866',
            'obra_social_id' => 4

        ]);


        // PACIENTE 17
        Paciente::create([

            'user_id'=> 20,
            'phone' => '3764951772',
            'obra_social_id' => 3

        ]);


        // PACIENTE 18
        Paciente::create([

            'user_id'=> 21,
            'phone' => '3764210657',
            'obra_social_id' => 3

        ]);


        // PACIENTE 19
        Paciente::create([

            'user_id'=> 22,
            'phone' => '3764849833',
            'obra_social_id' => 2

        ]);

        // PACIENTE 20
        Paciente::create([

            'user_id'=> 23,
            'phone' => '37647924818',
            'obra_social_id' => 2

        ]);

        // PACIENTE 21
        Paciente::create([

            'user_id'=> 24,
            'phone' => '3766001333',
            'obra_social_id' => 1

        ]);


        // PACIENTE 22
        Paciente::create([

            'user_id'=> 25,
            'phone' => '3764801401',
            'obra_social_id' => 1

        ]);


        // PACIENTE 23
        Paciente::create([

            'user_id'=> 26,
            'phone' => '3765315127',
            'obra_social_id' => 4

        ]);


        // PACIENTE 24
        Paciente::create([

            'user_id'=> 27,
            'phone' => '3765315100',
            'obra_social_id' => 4

        ]);

        // PACIENTE 25
        Paciente::create([

            'user_id'=> 28,
            'phone' => '3765315188',
            'obra_social_id' => 4

        ]);
    }
}
