<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'role_id' => 1,
                'name' => 'Muhammad Rizky',
                'email' => 'rizkytemp26@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'role_id' => 1,
                'name' => 'Candra Komala',
                'email' => 'candrakomala69@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'role_id' => 2,
                'name' => 'Suphendi',
                'email' => 'suphendi@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'role_id' => 3,
                'name' => 'Kartini',
                'email' => 'kartini@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'role_id' => 3,
                'name' => 'Ihsan Amala',
                'email' => 'ihsan@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
