<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@ashoes.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@ashoes.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create regular user
        User::firstOrCreate(
            ['email' => 'user@ashoes.com'],
            [
                'name' => 'Regular User',
                'email' => 'user@ashoes.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Created admin user: admin@ashoes.com (password: admin123)');
        $this->command->info('Created regular user: user@ashoes.com (password: user123)');
    }
}
