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
        User::create([
            'first_name' => 'Luis',
            'last_name' => 'Zelaya',
            'email' => 'luis@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Gustavo',
            'last_name' => 'Benitez',
            'email' => 'gustavo@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Felicia',
            'last_name' => 'Martinez',
            'email' => 'felicia@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Daniel',
            'last_name' => 'Ojeda',
            'email' => 'dany@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Lautaro',
            'last_name' => 'Bordon',
            'email' => 'lautaro@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Lidia',
            'last_name' => 'Villalba',
            'email' => 'lidia@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Felipe',
            'last_name' => 'Saucedo',
            'email' => 'felipe@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Carlos',
            'last_name' => 'Zelaya',
            'email' => 'carlos@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Gabriel',
            'last_name' => 'Knott',
            'email' => 'gabriel@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Hortencia',
            'last_name' => 'Lopez',
            'email' => 'hortencia@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Giovanni',
            'last_name' => 'Zelaya',
            'email' => 'giovanni@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Miguel',
            'last_name' => 'González',
            'email' => 'miguel@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Pedro',
            'last_name' => 'Alonso',
            'email' => 'pedro@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Ana',
            'last_name' => 'Quiroga',
            'email' => 'ana@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Yael',
            'last_name' => 'Rodriguez',
            'email' => 'yael@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Adrián',
            'last_name' => 'Jiménez',
            'email' => 'adrian@gmail.com',
            'password' => bcrypt('12345')
        ]);
        User::create([
            'first_name' => 'Lucas',
            'last_name' => 'Romero',
            'email' => 'lucas@gmail.com',
            'password' => bcrypt('12345')
        ]);
        
    }
}
