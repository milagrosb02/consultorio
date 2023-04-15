<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ProfesionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // CREO DOC 1
         User::create([

            'first_name' => 'Beatriz',
            'last_name' => 'Padros',
            'user' => 'docpadros',
            'email' => 'docb@gmail.com',
            'password' => bcrypt('padros123')

        ])->assignRole('profesional');




         // CREO DOC 2
         User::create([

            'first_name' => 'Gabriela',
            'last_name' => 'Galmarini',
            'user' => 'docgalmarini',
            'email' => 'docg@gmail.com',
            'password' => bcrypt('galmarini123')

        ])->assignRole('profesional');
    }
}
