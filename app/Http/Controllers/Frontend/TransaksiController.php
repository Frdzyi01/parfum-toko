<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Riwayat transaksi milik customer yang login.
     */
    public function index()
    {
        $transaksi = Auth::user()
            ->transaksi()
            ->latest()
            ->paginate(10);

        return view('frontend.transaksi.index', compact('transaksi'));
    }

    /**
     * Detail transaksi berdasarkan invoice number.
     * Customer hanya bisa melihat transaksi miliknya sendiri.
     */
    public function tampilkan(string $invoice)
    {
        $transaksi = Auth::user()
            ->transaksi()
            ->with('item.produk')
            ->where('nomor_invoice', $invoice)
            ->firstOrFail();

        return view('frontend.transaksi.show', compact('transaksi'));
    }

    /**
     * Halaman pembayaran QRIS.
     */
    public function pembayaran(string $invoice)
    {
        $transaksi = Auth::user()
            ->transaksi()
            ->with('item.produk')
            ->where('nomor_invoice', $invoice)
            ->firstOrFail();

        // Jika sudah dibayar, redirect ke detail
        if (!$transaksi->apakahBisaBayar()) {
            return redirect()
                ->route('transaksi.tampilkan', $transaksi->nomor_invoice)
                ->with('info', 'Transaksi ini sudah dibayar atau tidak memerlukan pembayaran.');
        }

        return view('frontend.transaksi.pembayaran', compact('transaksi'));
    }

    /**
     * Upload bukti pembayaran.
     */
    public function uploadBukti(Request $request, string $invoice)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'bukti_pembayaran.required' => 'Silakan upload bukti pembayaran.',
            'bukti_pembayaran.image'    => 'File harus berupa gambar.',
            'bukti_pembayaran.mimes'    => 'Format file harus JPG, JPEG, atau PNG.',
            'bukti_pembayaran.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $transaksi = Auth::user()
            ->transaksi()
            ->where('nomor_invoice', $invoice)
            ->firstOrFail();

        if (!$transaksi->apakahBisaBayar()) {
            return redirect()
                ->route('transaksi.tampilkan', $transaksi->nomor_invoice)
                ->with('error', 'Transaksi ini sudah tidak dapat dibayar.');
        }

        // Simpan file bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

        // Update transaksi
        $transaksi->update([
            'bukti_pembayaran' => $path,
            'status'           => 'dibayar',
            'dibayar_pada'     => now(),
        ]);

        return redirect()
            ->route('transaksi.tampilkan', $transaksi->nomor_invoice)
            ->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }
}

