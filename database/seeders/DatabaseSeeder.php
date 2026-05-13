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
        // Admin user
        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // or use Hash::make('password') if Hash facade is imported
            'role' => 'admin',
        ]);

        // Demo user
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user', // Assuming default role might be user, good to set explicitly if there's a role system
        ]);

        // Seed produk parfum
        $this->call(ProductSeeder::class);
    }
}
