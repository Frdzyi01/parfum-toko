<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'report');

        if ($tab === 'all_orders') {
            $transactions = Transaction::with('user')->latest()->paginate(10)->withQueryString();
            return view('backend.transactions.index', compact('transactions', 'tab'));
        }

        // Date range report filters
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        if ($startDateInput) {
            $startDate = \Carbon\Carbon::parse($startDateInput)->startOfDay();
        } else {
            $startDate = \Carbon\Carbon::now()->startOfMonth()->startOfDay();
        }

        if ($endDateInput) {
            $endDate = \Carbon\Carbon::parse($endDateInput)->endOfDay();
        } else {
            $endDate = \Carbon\Carbon::now()->endOfMonth()->endOfDay();
        }

        // Query transactions in range
        $query = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled');

        $totalTransactions = $query->count();
        $totalRevenue = $query->sum('total');
        $averageTransaction = $totalTransactions > 0 ? ($totalRevenue / $totalTransactions) : 0;

        // Group daily sales report data
        $reportData = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total) as revenue')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('backend.transactions.index', compact(
            'reportData',
            'totalTransactions',
            'totalRevenue',
            'averageTransaction',
            'startDate',
            'endDate',
            'tab'
        ));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('items.product', 'user');
        return view('backend.transactions.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.transactions.show', $transaction)->with('success', 'Transaction status updated.');
    }
}
