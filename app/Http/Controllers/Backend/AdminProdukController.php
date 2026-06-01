<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->paginate(10);
        return view('backend.produk.index', compact('produk'));
    }

    public function buat()
    {
        return view('backend.produk.buat');
    }

    public function simpan(Request $request)
    {
        $tervalidasi = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $tervalidasi['slug'] = Str::slug($tervalidasi['nama']);

        if ($request->hasFile('gambar')) {
            $tervalidasi['gambar_mini'] = $request->file('gambar')->store('produk', 'public');
        }
        unset($tervalidasi['gambar']);

        Produk::create($tervalidasi);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function ubah(Produk $produk)
    {
        return view('backend.produk.ubah', compact('produk'));
    }

    public function perbarui(Request $request, Produk $produk)
    {
        $tervalidasi = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $tervalidasi['slug'] = Str::slug($tervalidasi['nama']);

        if ($request->hasFile('gambar')) {
            $tervalidasi['gambar_mini'] = $request->file('gambar')->store('produk', 'public');
        }
        unset($tervalidasi['gambar']);

        $produk->update($tervalidasi);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function hapus(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
