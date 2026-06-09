<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware; 
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{   
    public static function middleware(): array
    {
        return [
            new Middleware('admin', except: ['index', 'show']),
        ];
    }

    /**
     * Menampilkan semua data product
     */
    public function index()
    {
        // Mengambil seluruh data product dari database
        $productsByCategory = Product::all()->groupBy('category');
        // Mengirim data ke view index product
        return view('products.index', compact('productsByCategory'));
    }

    /**
     * Menampilkan form tambah product
     */
    public function create()
    {
        // Menampilkan halaman form untuk menambah product baru
        return view('products.create');
    }

    /**
     * Menyimpan data product baru ke database
     */
    public function store(Request $request)
    {
        // Validassi input dari user sebelum masuk ke database
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
        ]);

        // Menyimpan data product yang sudah divalidasi
        Product::create($validated);

        // Redirect ke halaman daftar product dengan pesan berhasil
        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail product beserta relasi review
     */
    public function show(Product $product)
    {
        // Menampilkan detail product
        return view('products.show', compact('product'));
    }

    /**
     * Menampilkan form edit product
     */
    public function edit(Product $product)
    {
        // Menampilkan form edit dengan data product yang dipilih
        return view('products.edit', compact('product'));
    }

    /**
     * Mengupdate data product
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input sebelum update ke database
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        // Update data product
        $product->update($validated);
        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil diupdate!');
    }

    /**
     * Menghapus data product dari database
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil dihapus!');
    }
}

