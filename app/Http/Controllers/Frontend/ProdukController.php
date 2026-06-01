<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Tampilkan halaman shop / katalog produk dengan pagination.
     */
    public function index(Request $request)
    {
        $query = Produk::aktif();

        // Filter pencarian
        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $kategori = (array) $request->kategori;
            // Jika 'Semua' dicentang, kita tidak memfilter berdasarkan kategori
            if (!in_array('Semua', $kategori) && count($kategori) > 0) {
                $query->whereIn('kategori', $kategori);
            }
        }

        // Filter rentang harga
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        $produk = $query->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('frontend.toko.index', compact('produk'));
    }

    /**
     * Tampilkan detail produk berdasarkan slug.
     */
    public function tampilkan(string $slug)
    {
        $produk = Produk::aktif()
            ->where('slug', $slug)
            ->firstOrFail();

        // Produk terkait (bukan produk yang sedang dilihat)
        $produkTerkait = Produk::aktif()
            ->where('id', '!=', $produk->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('frontend.produk.detail', compact('produk', 'produkTerkait'));
    }
}
