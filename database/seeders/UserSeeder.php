<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' =>  "admin",
            'email' => "admin@gmail.com",
            'password' => "admin123",
            'isAdmin' => 1
        ]);
        User::create([
            'name' =>  "user",
            'email' => "user@gmail.com",
            'password' => "user123",
            'isAdmin' => 0
        ]);
    }
}
