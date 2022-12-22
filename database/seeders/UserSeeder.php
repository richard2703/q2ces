<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'a@a.com',
            'username' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('Admin');

        $user = User::create([
            'name' => 'Programador',
            'email' => 'programador@bconfig.com',
            'username' => 'programador',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('Admin');

        $user = User::create([
            'name' => 'usuario',
            'email' => 'usuario@a.com',
            'username' => 'Usuario',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('User');

    }
}
