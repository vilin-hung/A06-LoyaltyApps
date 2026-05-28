<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redeems = Redeem::all();

        return view('redeem.index', compact('redeems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vouchers = Voucher::all();

        return view('redeem.redeem-form', compact('vouchers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
            'points_spent' => 'required|integer',
        ]);

        Redeem::create([
            'user_id' => Auth::id(),
            'voucher_id' => $request->voucher_id,
            'points_spent' => $request->points_spent,
        ]);

        return redirect()->route('redeem.history')
            ->with('success', 'Redeem berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Redeem $redeem)
    {
        return view('redeem.show', compact('redeem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Redeem $redeem)
    {
        $vouchers = Voucher::all();

        return view('redeem.edit', compact('redeem', 'vouchers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Redeem $redeem)
    {
        $request->validate([
            'voucher_id' => 'required',
            'points_spent' => 'required|integer',
        ]);

        $redeem->update([
            'voucher_id' => $request->voucher_id,
            'points_spent' => $request->points_spent,
        ]);

        return redirect()->route('redeem.index')
            ->with('success', 'Redeem updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Redeem $redeem)
    {
        $redeem->delete();

        return redirect()->route('redeem.index')
            ->with('success', 'Redeem deleted successfully');
    }

    /**
     * Display redeem history.
     */
    public function history()
    {
        $redeems = Redeem::where('user_id', Auth::id())->get();

        return view('redeem.redeem-history', compact('redeems'));
    }
}