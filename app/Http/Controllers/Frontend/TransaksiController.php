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

        return view('frontend.transaction.index', compact('transaksi'));
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

        return view('frontend.transaction.show', compact('transaksi'));
    }
}
