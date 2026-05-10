<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
        $transactions = Auth::user()
            ->transactions()
            ->latest()
            ->paginate(10);

        return view('frontend.transaction.index', compact('transactions'));
    }

    /**
     * Detail transaksi berdasarkan invoice number.
     * Customer hanya bisa melihat transaksi miliknya sendiri.
     */
    public function show(string $invoice)
    {
        $transaction = Auth::user()
            ->transactions()
            ->with('items.product')
            ->where('invoice_number', $invoice)
            ->firstOrFail();

        return view('frontend.transaction.show', compact('transaction'));
    }
}
