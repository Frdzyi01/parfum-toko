<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        if ($users->isEmpty()) {
            return;
        }

        $products = Product::all();
        if ($products->isEmpty()) {
            return;
        }

        // Create exactly 2 transactions
        for ($i = 0; $i < 2; $i++) {
            $user = $users->random();
            $date = Carbon::now()->subDays(rand(0, 20))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
            
            // Random status (completed is more likely for revenue stats)
            $statuses = ['pending', 'processing', 'completed', 'completed', 'completed'];
            $status = $statuses[array_rand($statuses)];

            // Create transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'invoice_number' => Transaction::generateInvoiceNumber(),
                'total' => 0,
                'status' => $status,
                'notes' => 'Catatan pesanan demo.',
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            // Add 1 to 3 items
            $total = 0;
            $itemsCount = rand(1, 3);
            // Ensure unique random products
            $itemsCount = min($itemsCount, $products->count());
            $selectedProducts = $products->random($itemsCount);

            // Handle collection vs single model random results
            $selectedProducts = $selectedProducts instanceof Product ? collect([$selectedProducts]) : $selectedProducts;

            foreach ($selectedProducts as $product) {
                $qty = rand(1, 2);
                $subtotal = $product->price * $qty;
                $total += $subtotal;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }

            // Update total
            $transaction->update(['total' => $total]);
        }
    }
}
