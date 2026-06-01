<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'laporan');

        if ($tab === 'semua_pesanan') {
            $transaksi = Transaksi::with('pengguna')->latest()->paginate(10)->withQueryString();
            return view('backend.transaksi.index', compact('transaksi', 'tab'));
        }

        // Date range report filters
        $tanggalMulaiInput = $request->input('tanggal_mulai');
        $tanggalSelesaiInput = $request->input('tanggal_selesai');

        if ($tanggalMulaiInput) {
            $tanggalMulai = \Carbon\Carbon::parse($tanggalMulaiInput)->startOfDay();
        } else {
            $tanggalMulai = \Carbon\Carbon::now()->startOfMonth()->startOfDay();
        }

        if ($tanggalSelesaiInput) {
            $tanggalSelesai = \Carbon\Carbon::parse($tanggalSelesaiInput)->endOfDay();
        } else {
            $tanggalSelesai = \Carbon\Carbon::now()->endOfMonth()->endOfDay();
        }

        // Query transactions in range
        $query = Transaksi::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->where('status', '!=', 'cancelled');

        $totalTransaksi = $query->count();
        $totalPendapatan = $query->sum('total');
        $rataRataTransaksi = $totalTransaksi > 0 ? ($totalPendapatan / $totalTransaksi) : 0;

        // Group daily sales report data
        $dataLaporan = Transaksi::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->where('status', '!=', 'cancelled')
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah, SUM(total) as pendapatan')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('backend.transaksi.index', compact(
            'dataLaporan',
            'totalTransaksi',
            'totalPendapatan',
            'rataRataTransaksi',
            'tanggalMulai',
            'tanggalSelesai',
            'tab'
        ));
    }

    public function tampilkan(Transaksi $transaksi)
    {
        $transaksi->load('item.produk', 'pengguna');
        return view('backend.transaksi.show', compact('transaksi'));
    }

    public function perbarui(Request $request, Transaksi $transaksi)
    {
        $tervalidasi = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $transaksi->update($tervalidasi);

        return redirect()->route('admin.transaksi.show', $transaksi)->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
