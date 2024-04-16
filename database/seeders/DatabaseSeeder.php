<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@ex.com'],
            [
                'name' => 'Test User',
                'password' => 1234,
                'is_admin' => false,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@ex.com'],
            [
                'name' => 'Admin User',
                'password' => 1234,
                'is_admin' => true,
            ]
        );
    }
}
