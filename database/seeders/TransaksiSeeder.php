<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $pengguna = Pengguna::where('peran', 'pengguna')->get();
        if ($pengguna->isEmpty()) {
            return;
        }

        $produk = Produk::all();
        if ($produk->isEmpty()) {
            return;
        }

        // Create exactly 2 transactions
        for ($i = 0; $i < 2; $i++) {
            $user = $pengguna->random();
            $date = Carbon::now()->subDays(rand(0, 20))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
            
            // Random status (completed, dibayar, or menunggu_pembayaran)
            $statuses = ['menunggu_pembayaran', 'dibayar', 'completed'];
            $status = $statuses[$i % count($statuses)];

            $metode_pembayaran = in_array($status, ['dibayar', 'completed']) ? 'QRIS' : null;
            $bukti_pembayaran = in_array($status, ['dibayar', 'completed']) ? 'bukti-pembayaran/demo.png' : null;
            $dibayar_pada = in_array($status, ['dibayar', 'completed']) ? $date->copy()->addMinutes(rand(5, 30)) : null;

            // Create transaction
            $transaksi = Transaksi::create([
                'pengguna_id' => $user->id,
                'nomor_invoice' => Transaksi::buatNomorInvoice(),
                'total' => 0,
                'status' => $status,
                'catatan' => 'Catatan pesanan demo.',
                'metode_pembayaran' => $metode_pembayaran,
                'bukti_pembayaran' => $bukti_pembayaran,
                'dibayar_pada' => $dibayar_pada,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            // Add 1 to 3 items
            $total = 0;
            $itemsCount = rand(1, 3);
            // Ensure unique random products
            $itemsCount = min($itemsCount, $produk->count());
            $selectedProducts = $produk->random($itemsCount);

            // Handle collection vs single model random results
            $selectedProducts = $selectedProducts instanceof Produk ? collect([$selectedProducts]) : $selectedProducts;

            foreach ($selectedProducts as $itemProduk) {
                $jumlah = rand(1, 2);
                $subtotal = $itemProduk->harga * $jumlah;
                $total += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $itemProduk->id,
                    'jumlah' => $jumlah,
                    'harga' => $itemProduk->harga,
                    'subtotal' => $subtotal,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }

            // Update total
            $transaksi->update(['total' => $total]);
        }
    }
}
