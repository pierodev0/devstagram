<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "user1",
            'username' => "user1",
            'email' => "user1@gmail.com",
            'password' => Hash::make("123456"),
        ]);

        User::create([
            'name' => "user2",
            'username' => "user2",
            'email' => "user2@gmail.com",
            'password' => Hash::make("123456"),
        ]);

        User::create([
            'name' => "user3",
            'username' => "user3",
            'email' => "user3@gmail.com",
            'password' => Hash::make("123456"),
        ]);

        User::create([
            'name' => "user4",
            'username' => "user4",
            'email' => "user4@gmail.com",
            'password' => Hash::make("123456"),
        ]);
    }
}
