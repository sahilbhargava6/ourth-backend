<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user for testing
        User::updateOrCreate(
            ['email' => 'admin@ourth.local'],
            [
                'name' => 'Admin User',
                'email' => 'admin@ourth.local',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create government user for testing
        User::updateOrCreate(
            ['email' => 'government@ourth.local'],
            [
                'name' => 'Government Officer',
                'email' => 'government@ourth.local',
                'password' => Hash::make('password123'),
                'role' => 'government',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully.');
    }
}
