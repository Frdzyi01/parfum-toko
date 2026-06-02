<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AdminPelangganController extends Controller
{
    /**
     * Tampilkan daftar pelanggan.
     */
    public function index()
    {
        $pelanggan = Pengguna::where('peran', 'pengguna')
            ->withCount('transaksi')
            ->withSum('transaksi as total_belanja', 'total')
            ->latest()
            ->paginate(10);

        $totalPelanggan = Pengguna::where('peran', 'pengguna')->count();

        return view('backend.pelanggan.index', compact('pelanggan', 'totalPelanggan'));
    }

    /**
     * Tampilkan detail pelanggan dan riwayat transaksinya.
     */
    public function tampilkan(Pengguna $pelanggan)
    {
        // Pastikan hanya melihat pengguna dengan peran pelanggan
        if ($pelanggan->peran !== 'pengguna') {
            abort(404);
        }

        $pelanggan->load(['transaksi' => function ($query) {
            $query->latest();
        }]);

        $totalTransaksi = $pelanggan->transaksi->count();
        $totalBelanja = $pelanggan->transaksi->sum('total');

        return view('backend.pelanggan.show', compact('pelanggan', 'totalTransaksi', 'totalBelanja'));
    }
}
