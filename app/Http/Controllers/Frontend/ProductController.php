<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan halaman shop / katalog produk dengan pagination.
     */
    public function index(Request $request)
    {
        $products = Product::active()
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('frontend.shop.shop', compact('products'));
    }

    /**
     * Tampilkan detail produk berdasarkan slug.
     */
    public function show(string $slug)
    {
        $product = Product::active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Related products (bukan produk yang sedang dilihat)
        $relatedProducts = Product::active()
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('frontend.product.product-details', compact('product', 'relatedProducts'));
    }
}
