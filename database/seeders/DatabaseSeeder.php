<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@biblioteca.test',
            'password' => '$2y$10$ngG0JQ4GjGGij9BPm9Ia3uYU6q6pGzYS8QEjhn8QMw/1RER5Bd3U.',
            'email_verified_at' => '2023-03-23 00:00:00',
        ]);
    }
}
