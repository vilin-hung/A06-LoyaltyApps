<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::orderBy('min_transaction', 'asc')->get();
        return view('memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        return view('memberships.create');
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
            'level' => 'required|string|max:255',
            'min_transaction' => 'required|integer|min:0',
            'point_multiplier' => 'required|integer|min:1',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        Membership::create($validated);
        return redirect()->route('memberships.index')->with('success', 'Tier Membership berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        return view('memberships.show', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        return view('memberships.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'level' => 'required|string|max:255',
            'min_transaction' => 'required|integer|min:0',
            'point_multiplier' => 'required|integer|min:1',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $membership->update($validated);
        return redirect()->route('memberships.index')->with('success', 'Tier Membership berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }
        
        $membership->delete();
        return redirect()->route('memberships.index')->with('success', 'Tier Membership berhasil dihapus!');
    }
}
