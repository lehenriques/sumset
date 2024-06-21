<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\StatusEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User Administrator',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => StatusEnum::ADMIN->value
            ],
            [
                'name' => 'User Cliente',
                'email' => 'client@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => StatusEnum::CLIENT->value
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
