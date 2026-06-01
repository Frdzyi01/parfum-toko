<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Bersihkan database terlebih dahulu agar hanya menyisakan data seeder
        Schema::disableForeignKeyConstraints();
        \App\Models\DetailTransaksi::query()->delete();
        \App\Models\Transaksi::query()->delete();
        \App\Models\Produk::query()->delete();
        Pengguna::query()->delete();
        Schema::enableForeignKeyConstraints();

        // Pengguna Admin
        Pengguna::create([
            'nama'  => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);

        // Pengguna Demo
        Pengguna::create([
            'nama'  => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'peran' => 'pengguna',
        ]);

        // Seed produk parfum
        $this->call(ProdukSeeder::class);

        // Seed transaksi
        $this->call(TransaksiSeeder::class);
    }
}
