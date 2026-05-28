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
        $query = Product::active();

        // Filter by Search Query
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by Categories
        if ($request->filled('category')) {
            $categories = (array) $request->category;
            // If 'Semua' is checked, we don't filter by category (show all)
            if (!in_array('Semua', $categories) && count($categories) > 0) {
                $query->whereIn('category', $categories);
            }
        }

        // Filter by Price Range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

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
