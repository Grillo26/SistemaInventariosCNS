<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Str;




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
            'name' => 'Carlos Enrique',
            'lastname' => 'Mamani Torrez',
            'username' => 'admin',
            'email' => 'valla@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('kuynva26101997'),
            'remember_token' => Str::random(10)

        ])->assignRole('Admin');

        User::create([
            'name' => 'Benjamín',
            'lastname' => 'Montero',
            'username' => 'admin1',
            'email' => 'benja@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('kuynva26101997'),
            'remember_token' => Str::random(10)

        ])->assignRole('Admin');

        User::factory(9)->create();

    }
}
