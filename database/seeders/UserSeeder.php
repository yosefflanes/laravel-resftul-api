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
        User::firstOrCreate(
            ['email' => 'jane@mail.com'],
            [
                'name'     => 'Jane',
                'password' => Hash::make('Instructor123'),
                'role'     => 'instructor',
            ]
        );

        User::firstOrCreate(
            ['email' => 'john@mail.com'],
            [
                'name'     => 'John',
                'password' => Hash::make('Instructor123'),
                'role'     => 'instructor',
            ]
        );

        User::firstOrCreate(
            ['email' => 'alice@mail.com'],
            [
                'name'     => 'Alice',
                'password' => Hash::make('Student123'),
                'role'     => 'student',
            ]
        );

        User::firstOrCreate(
            ['email' => 'boby@mail.com'],
            [
                'name'     => 'Boby',
                'password' => Hash::make('Student123'),
                'role'     => 'student',
            ]
        );
    }
}