<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clean up database first to leave exactly the seeded data
        Schema::disableForeignKeyConstraints();
        \App\Models\TransactionItem::query()->delete();
        \App\Models\Transaction::query()->delete();
        \App\Models\Product::query()->delete();
        User::query()->delete();
        Schema::enableForeignKeyConstraints();

        // Admin user
        User::create([
            'name'  => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Demo user
        User::create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Seed produk parfum
        $this->call(ProductSeeder::class);

        // Seed transactions
        $this->call(TransactionSeeder::class);
    }
}
