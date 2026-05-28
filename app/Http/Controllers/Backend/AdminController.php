<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalRevenue = Transaction::whereIn('status', ['processing', 'completed'])->sum('total');
        $totalOrders = Transaction::count();
        $totalProducts = Product::count();
        $totalCustomers = \App\Models\User::where('role', 'user')->count();
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();

        return view('backend.dashboard', compact('totalRevenue', 'totalOrders', 'totalProducts', 'totalCustomers', 'recentTransactions'));
    }
}
