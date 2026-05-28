<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }
        return view('vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
      abort(403);
    }

    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'code' => 'required|string|unique:vouchers,code|max:50',
      'description' => 'nullable|string',
      'points_required' => 'required|integer|min:0',
      'discount_type' => 'required|in:percentage,fixed',
      'discount_value' => 'required|integer|min:0',
      'quota' => 'required|integer|min:0',
      'start_date' => 'nullable|date',
      'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    $validated['is_active'] = $request->has('is_active');

    Voucher::create($validated);

    return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return view('vouchers.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        if (!auth()->user()->is_admin) {
        abort(403);
        }
        return view('vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        if (!auth()->user()->is_admin) {
        abort(403);
        }

        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:vouchers,code,' . $voucher->id,
        'description' => 'nullable|string',
        'points_required' => 'required|integer|min:0',
        'discount_type' => 'required|in:percentage,fixed',
        'discount_value' => 'required|integer|min:0',
        'quota' => 'required|integer|min:0',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $voucher->update($validated);

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        if (!auth()->user()->is_admin) {
        abort(403);
        }
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil dihapus!');
    }
}
