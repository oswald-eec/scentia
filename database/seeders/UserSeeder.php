<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Crear un administrador
        $admin = User::create([
            'name' => 'Osvaldo Erquicia Cespedes',
            'email' => 'oss.dev@test.com',
            'password' => bcrypt('test1234'),
        ]);
        $admin->assignRole('Admin');

        // Crear un instructor
        $instructor = User::create([
            'name' => 'Esteban Erquicia Cespedes',
            'email' => 'estb.dev@test.com',
            'password' => bcrypt('test1234'),
        ]);
        $instructor->assignRole('Instructor');

        // Crear 99 usuarios adicionales con roles aleatorios
        User::factory(99)->create()->each(function ($user) {
            $roles = ['Estudiante', 'Instructor'];
            $user->assignRole($roles[array_rand($roles)]);
        });
    }
}
