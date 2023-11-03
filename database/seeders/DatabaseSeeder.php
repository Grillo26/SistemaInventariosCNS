<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Carlos Enrique';
        $user->lastname = 'Mamani Torrez';
        $user->username = 'grillo26';
        $user->email = 'carlsenrmt26@gmail.com';
        $user->email_verified_at = now();
        $user->password =  bcrypt('kuynva26101997');
        $user->remember_token = Str::random(10);
        $user->save();

        $user2 = new User();
        $user2->name = 'Alejandra';
        $user2->lastname = 'Mamani Torrez';
        $user2->username = 'ale';
        $user2->email = 'ale@gmail.com';
        $user2->email_verified_at = now();
        $user2->password =  bcrypt('kuynva26101997');
        $user2->remember_token = Str::random(10);
        $user2->save();

    
    }
}
