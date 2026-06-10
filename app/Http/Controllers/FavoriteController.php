<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display user's favorite products.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {

            $favorites = Favorite::selectRaw('product_id, COUNT(*) as total')
                ->with('product')
                ->groupBy('product_id')
                ->get();

            return view('favorites.admin', compact('favorites'));
        }

        $favorites = Favorite::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('favorites.index', compact('favorites'));
    }
    

    /**
     * Add product to favorites.
     */
    public function store(Product $product)
    {
        $exists = Favorite::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke favorit');
    }

    /**
     * Remove product from favorites.
     */
    public function destroy(Product $product)
    {
        Favorite::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Produk berhasil dihapus dari favorit');
    }
}