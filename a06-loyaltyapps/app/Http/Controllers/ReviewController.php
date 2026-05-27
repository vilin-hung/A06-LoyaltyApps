<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->get();
        return view('reviews.index', compact('reviews'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::find($request->product_id);
        return view('reviews.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Review::create([
            'user_id' => Auth()::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
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
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        if (Auth::id() != $review->user_id) {
        abort(403);
        }
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        if (Auth::id() != $review->user_id) {
            abort(403);
        }
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->route('products.show', $review->product_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
        $review->delete();
        return redirect()->back();
    }
}
