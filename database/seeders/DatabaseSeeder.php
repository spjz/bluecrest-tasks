<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the users table first
        User::truncate();
        Task::truncate();

        // Use same password for each user
        $password = Hash::make('password');

        // Create admin user
        User::factory()
            ->has(Task::factory()->count(10))
            ->create([
                'name' => 'Administrator',
                'email' => 'admin@test.com',
                'password' => $password,
            ]);

        User::factory()
            ->has(Task::factory()->count(10))
            ->count(5)
            ->create([
                'password' => $password,
            ]);
    }
}
