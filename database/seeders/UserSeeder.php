<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PACIENTE 1
        User::create([
            'first_name' => 'Luis',
            'last_name' => 'Zelaya',
            'email' => 'luis@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 2
        User::create([
            'first_name' => 'Gustavo',
            'last_name' => 'Benitez',
            'email' => 'gustavo@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 3
        User::create([
            'first_name' => 'Felicia',
            'last_name' => 'Martinez',
            'email' => 'felicia@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 4
        User::create([
            'first_name' => 'Daniel',
            'last_name' => 'Ojeda',
            'email' => 'dany@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 5
        User::create([
            'first_name' => 'Lautaro',
            'last_name' => 'Bordon',
            'email' => 'lautaro@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 6
        User::create([
            'first_name' => 'Lidia',
            'last_name' => 'Villalba',
            'email' => 'lidia@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 7
        User::create([
            'first_name' => 'Felipe',
            'last_name' => 'Saucedo',
            'email' => 'felipe@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 8
        User::create([
            'first_name' => 'Carlos',
            'last_name' => 'Zelaya',
            'email' => 'carlos@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 9
        User::create([
            'first_name' => 'Gabriel',
            'last_name' => 'Estevanez',
            'email' => 'gabriel@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 10
        User::create([
            'first_name' => 'Hortencia',
            'last_name' => 'Lopez',
            'email' => 'hortencia@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 11
        User::create([
            'first_name' => 'Giovanni',
            'last_name' => 'Zelaya',
            'email' => 'giovanni@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 12
        User::create([
            'first_name' => 'Miguel',
            'last_name' => 'González',
            'email' => 'miguel@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 13
        User::create([
            'first_name' => 'Pedro',
            'last_name' => 'Alonso',
            'email' => 'pedro@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 14
        User::create([
            'first_name' => 'Ana',
            'last_name' => 'Quiroga',
            'email' => 'ana@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 15
        User::create([
            'first_name' => 'Yael',
            'last_name' => 'Rodriguez',
            'email' => 'yael@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 16
        User::create([
            'first_name' => 'Adrián',
            'last_name' => 'Jiménez',
            'email' => 'adrian@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 17
        User::create([
            'first_name' => 'Lucas',
            'last_name' => 'Romero',
            'email' => 'lucas@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 18
        User::create([
            'first_name' => 'Florencia',
            'last_name' => 'Rodriguez',
            'email' => 'flor@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 19
        User::create([
            'first_name' => 'Agostina',
            'last_name' => 'Duarte',
            'email' => 'agos@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 20
        User::create([
            'first_name' => 'Antonia',
            'last_name' => 'Nuñez',
            'email' => 'antonia@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 21
        User::create([
            'first_name' => 'Elias',
            'last_name' => 'Alvez',
            'email' => 'elias@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 22
        User::create([
            'first_name' => 'Fernando',
            'last_name' => 'Garcia',
            'email' => 'fernando@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 23
        User::create([
            'first_name' => 'Melina',
            'last_name' => 'Benitez',
            'email' => 'melina@gmail.com',
            'password' => bcrypt('12345')
        ]);
       

        // PACIENTE 24
        User::create([
            'first_name' => 'Carol',
            'last_name' => 'Irala',
            'email' => 'carol@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // PACIENTE 25
        User::create([
            'first_name' => 'Mario',
            'last_name' => 'Balmaceda',
            'email' => 'mario@gmail.com',
            'password' => bcrypt('12345')
        ]);
        
    }
}
