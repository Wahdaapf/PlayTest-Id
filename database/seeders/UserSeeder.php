<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table with default users for each role.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'              => 'Admin',
                'password'          => bcrypt('123456'),
                'role'              => UserRole::admin,
                'email_verified_at' => now(),
            ]
        );

        // Developer
        User::updateOrCreate(
            ['email' => 'developer@gmail.com'],
            [
                'name'              => 'Developer',
                'password'          => bcrypt('123456'),
                'role'              => UserRole::developer,
                'email_verified_at' => now(),
            ]
        );

        // Tester
        User::updateOrCreate(
            ['email' => 'tester@gmail.com'],
            [
                'name'              => 'Tester',
                'password'          => bcrypt('123456'),
                'role'              => UserRole::tester,
                'email_verified_at' => now(),
            ]
        );
    }
}
