<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $produkHero = Produk::latest()->take(5)->get();
        $produkBaru = Produk::latest()->take(8)->get();
        $trenPopuler = Produk::inRandomOrder()->take(3)->get();
        $terlaris = Produk::inRandomOrder()->take(3)->get();
        $unggulan = Produk::inRandomOrder()->take(3)->get();

        return view('frontend.dashboard', compact('produkHero', 'produkBaru', 'trenPopuler', 'terlaris', 'unggulan'));
    }
}
