<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalPendapatan = Transaksi::whereIn('status', ['processing', 'completed'])->sum('total');
        $totalPesanan = Transaksi::count();
        $totalProduk = Produk::count();
        $totalPelanggan = Pengguna::where('peran', 'pengguna')->count();
        $transaksiTerbaru = Transaksi::with('pengguna')->latest()->take(5)->get();

        return view('backend.dashboard', compact('totalPendapatan', 'totalPesanan', 'totalProduk', 'totalPelanggan', 'transaksiTerbaru'));
    }
}
