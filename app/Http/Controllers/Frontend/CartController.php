<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman keranjang.
     */
    public function index()
    {
        $cart = Auth::user()->getOrCreateCart();
        $cart->load('items.product');

        return view('frontend.transaction.cart', compact('cart'));
    }

    /**
     * Tambahkan produk ke keranjang.
     */
    public function add(Request $request, int $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::active()->findOrFail($id);

        // Cek stock
        if ($product->stock < 1) {
            return back()->with('error', 'Produk ' . $product->name . ' sedang tidak tersedia (stok habis).');
        }

        $qty = (int) $request->qty;

        if ($qty > $product->stock) {
            return back()->with('error', 'Qty melebihi stok yang tersedia (' . $product->stock . ').');
        }

        $cart = Auth::user()->getOrCreateCart();

        // Jika produk sudah ada di cart, update qty
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQty = $cartItem->qty + $qty;

            if ($newQty > $product->stock) {
                return back()->with('error', 'Total qty melebihi stok yang tersedia (' . $product->stock . ').');
            }

            $cartItem->qty     = $newQty;
            $cartItem->subtotal = $newQty * $cartItem->price;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'qty'        => $qty,
                'price'      => $product->price,
                'subtotal'   => $qty * $product->price,
            ]);
        }

        if ($request->has('buy_now')) {
            return redirect()->route('checkout.index')->with('success', 'Produk berhasil ditambahkan.');
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update qty item di keranjang.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cart     = Auth::user()->getOrCreateCart();
        $cartItem = $cart->items()->where('product_id', $id)->firstOrFail();
        $qty      = (int) $request->qty;

        if ($qty > $cartItem->product->stock) {
            return back()->with('error', 'Qty melebihi stok yang tersedia (' . $cartItem->product->stock . ').');
        }

        $cartItem->qty      = $qty;
        $cartItem->subtotal = $qty * $cartItem->price;
        $cartItem->save();

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Hapus item dari keranjang.
     */
    public function remove(int $id)
    {
        $cart = Auth::user()->getOrCreateCart();
        $cart->items()->where('product_id', $id)->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
