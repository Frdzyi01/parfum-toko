<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\ItemKeranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
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
        $keranjang = Auth::user()->ambilAtauBuatKeranjang();
        $keranjang->load('item.produk');

        return view('frontend.transaction.cart', compact('keranjang'));
    }

    /**
     * Tambahkan produk ke keranjang.
     */
    public function tambah(Request $request, int $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::aktif()->findOrFail($id);

        // Cek stok
        if ($produk->stok < 1) {
            return back()->with('error', 'Produk ' . $produk->nama . ' sedang tidak tersedia (stok habis).');
        }

        $jumlah = (int) $request->jumlah;

        if ($jumlah > $produk->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia (' . $produk->stok . ').');
        }

        $keranjang = Auth::user()->ambilAtauBuatKeranjang();

        // Jika produk sudah ada di keranjang, update jumlah
        $itemKeranjang = $keranjang->item()->where('produk_id', $produk->id)->first();

        if ($itemKeranjang) {
            $jumlahBaru = $itemKeranjang->jumlah + $jumlah;

            if ($jumlahBaru > $produk->stok) {
                return back()->with('error', 'Total jumlah melebihi stok yang tersedia (' . $produk->stok . ').');
            }

            $itemKeranjang->jumlah   = $jumlahBaru;
            $itemKeranjang->subtotal = $jumlahBaru * $itemKeranjang->harga;
            $itemKeranjang->save();
        } else {
            $keranjang->item()->create([
                'produk_id' => $produk->id,
                'jumlah'    => $jumlah,
                'harga'     => $produk->harga,
                'subtotal'  => $jumlah * $produk->harga,
            ]);
        }

        if ($request->has('beli_sekarang')) {
            return redirect()->route('pemesanan.index')->with('success', 'Produk berhasil ditambahkan.');
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update jumlah item di keranjang.
     */
    public function perbarui(Request $request, int $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang     = Auth::user()->ambilAtauBuatKeranjang();
        $itemKeranjang = $keranjang->item()->where('produk_id', $id)->firstOrFail();
        $jumlah        = (int) $request->jumlah;

        if ($jumlah > $itemKeranjang->produk->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia (' . $itemKeranjang->produk->stok . ').');
        }

        $itemKeranjang->jumlah   = $jumlah;
        $itemKeranjang->subtotal = $jumlah * $itemKeranjang->harga;
        $itemKeranjang->save();

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Hapus item dari keranjang.
     */
    public function hapus(int $id)
    {
        $keranjang = Auth::user()->ambilAtauBuatKeranjang();
        $keranjang->item()->where('produk_id', $id)->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
