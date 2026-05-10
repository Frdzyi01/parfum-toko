<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman checkout.
     */
    public function index()
    {
        $cart = Auth::user()->getOrCreateCart();
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        return view('frontend.transaction.checkout', compact('cart'));
    }

    /**
     * Proses checkout: simpan transaksi, kosongkan cart.
     */
    public function process(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $cart = $user->getOrCreateCart();
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Validasi ulang stok sebelum checkout
        foreach ($cart->items as $item) {
            if (!$item->product->isActive()) {
                return back()->with('error', 'Produk "' . $item->product->name . '" sudah tidak aktif.');
            }
            if ($item->qty > $item->product->stock) {
                return back()->with('error', 'Stok produk "' . $item->product->name . '" tidak mencukupi.');
            }
        }

        DB::beginTransaction();

        try {
            $total = $cart->items->sum('subtotal');

            // Buat transaksi
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total'   => $total,
                'status'  => 'pending',
                'notes'   => $request->notes,
            ]);

            // Copy cart items ke transaction items & kurangi stok
            foreach ($cart->items as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $item->product_id,
                    'qty'            => $item->qty,
                    'price'          => $item->price,
                    'subtotal'       => $item->subtotal,
                ]);

                // Kurangi stok produk
                $item->product->decrement('stock', $item->qty);
            }

            // Kosongkan cart
            $cart->items()->delete();

            DB::commit();

            return redirect()
                ->route('transactions.show', $transaction->invoice_number)
                ->with('success', 'Pesanan Anda berhasil dibuat! Invoice: ' . $transaction->invoice_number);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }
    }
}
