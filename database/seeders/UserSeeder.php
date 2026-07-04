<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::firstOrCreate([
            'name'     => 'Jane',
            'email'    => 'jane@mail.com',
            'password' => 'Instructor123',
            'role'     => 'instructor',
        ]);

        User::firstOrCreate([
            'name'     => 'John',
            'email'    => 'john@mail.com',
            'password' => 'Instructor123',
            'role'     => 'instructor',
        ]);

        User::firstOrCreate([
            'name'     => 'Alice',
            'email'    => 'alice@mail.com',
            'password' => 'Student123',
            'role'     => 'student',
        ]);

        User::firstOrCreate([
            'name'     => 'Boby',
            'email'    => 'boby@mail.com',
            'password' => 'Student123',
            'role'     => 'student',
        ]);
    }
}
