<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Menampilkan daftar review 
     */
    public function index()
    {
        // Ambil semua review beserta relasi user dan product
        $reviews = Review::with(['user', 'product'])->get();
        // Kirim data ke view 
        return view('reviews.index', compact('reviews'));    
    }

    /**
     * Menampilkan form untuk menambahkan review baru pada product tertentu
     */
    public function create()
    {
        // Ambil data product berdasarkan product_id dari request URL
        $product = Product::findOrFail(request('product_id'));
        // Tampilkan form create review untuk product tersebut
        return view('reviews.create', compact('product'));
    }

    /**
     * Menyimpan review baru ke database
     */
    public function store(Request $request)
    {
        // Simpan review baru berdasarkan user yang sedang login
        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // redirect ke halaman detail product
        return redirect()->route('products.show', $request->product_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Menampilkan form edit review
     */
    public function edit(Review $review)
    {
        // Cek apakah user yang login adalah pemilik review
        if (Auth::id() != $review->user_id) {
        abort(403);
        }

        return view('reviews.edit', compact('review'));
    }

    /**
     * Mengupdate data review
     */
    public function update(Request $request, Review $review)
    {
        // Validasi kepemilikan review
        if (Auth::id() != $review->user_id) {
            abort(403);
        }
        // Update isi review
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->route('products.show', $review->product_id);
    }

    /**
     * Menghapus review dari database (Admin only)
     */
    public function destroy(Review $review)
    {
        // Admin saja yang bisa menghapus review
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
        // Menghapus review
        $review->delete();
        return redirect()->back();
    }
}
