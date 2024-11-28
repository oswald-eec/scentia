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
        $user = User::create([
                    'name'=>'Osvaldo Erquicia Cespedes',
                    'email' => 'oss.dev@test.com',
                    'password' => bcrypt('test1234')
                ]);
        $user->assignRole('Admin');

        $user1 = User::create([
            'name'=>'Esteban Erquicia Cespedes',
            'email' => 'estb.dev@test.com',
            'password' => bcrypt('test1234')
        ]);
        $user1->assignRole('Instructor');

        User::factory(99)->create();
    }
}
