<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@mailinator.com',
                'type' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@mailinator.com',
                'type' => 2,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User',
                'email' => 'user@mailinator.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
