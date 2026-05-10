<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroProducts = Product::latest()->take(5)->get();
        $newProducts = Product::latest()->take(8)->get();
        $hotTrend = Product::inRandomOrder()->take(3)->get();
        $bestSeller = Product::inRandomOrder()->take(3)->get();
        $feature = Product::inRandomOrder()->take(3)->get();

        return view('frontend.dashboard', compact('heroProducts', 'newProducts', 'hotTrend', 'bestSeller', 'feature'));
    }
}
