<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
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
        $keranjang = Auth::user()->ambilAtauBuatKeranjang();
        $keranjang->load('item.produk');

        if ($keranjang->item->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        return view('frontend.transaksi.checkout', compact('keranjang'));
    }

    /**
     * Proses checkout: simpan transaksi, kosongkan cart.
     */
    public function proses(Request $request)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:500',
        ]);

        $pengguna = Auth::user();
        $keranjang = $pengguna->ambilAtauBuatKeranjang();
        $keranjang->load('item.produk');

        if ($keranjang->item->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Validasi ulang stok sebelum checkout
        foreach ($keranjang->item as $item) {
            if (!$item->produk->apakahAktif()) {
                return back()->with('error', 'Produk "' . $item->produk->nama . '" sudah tidak aktif.');
            }
            if ($item->jumlah > $item->produk->stok) {
                return back()->with('error', 'Stok produk "' . $item->produk->nama . '" tidak mencukupi.');
            }
        }

        DB::beginTransaction();

        try {
            $total = $keranjang->item->sum('subtotal');

            // Buat transaksi
            $transaksi = Transaksi::create([
                'pengguna_id' => $pengguna->id,
                'total'       => $total,
                'status'      => 'pending',
                'catatan'     => $request->catatan,
            ]);

            // Copy item keranjang ke detail transaksi & kurangi stok
            foreach ($keranjang->item as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id'    => $item->produk_id,
                    'jumlah'       => $item->jumlah,
                    'harga'        => $item->harga,
                    'subtotal'     => $item->subtotal,
                ]);

                // Kurangi stok produk
                $item->produk->decrement('stok', $item->jumlah);
            }

            // Kosongkan keranjang
            $keranjang->item()->delete();

            DB::commit();

            return redirect()
                ->route('transaksi.tampilkan', $transaksi->nomor_invoice)
                ->with('success', 'Pesanan Anda berhasil dibuat! Invoice: ' . $transaksi->nomor_invoice);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }
    }
}
