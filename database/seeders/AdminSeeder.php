<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREO EL ADMIN
        User::create([

            'first_name' => 'Admin',
            'last_name' => 'Admin Admin',
            'user' => 'admin12',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')

        ])->assignRole('admin');
    }
}
