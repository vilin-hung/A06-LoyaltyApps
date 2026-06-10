<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
        ]);

        $user = Auth::user();
        $voucher = Voucher::findOrFail($request->voucher_id);

        if ($user->points < $voucher->points_required) {
            return back()->with('error', 'Poin tidak cukup');
        }

        if ($voucher->quota <= 0) {
            return back()->with('error', 'Voucher habis');
        }

        Redeem::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'points_spent' => $voucher->points_required,
        ]);

        $user->points -= $voucher->points_required;
        $user->save();

        $voucher->quota -= 1;
        $voucher->save();

        return redirect()
            ->route('redeems.index')
            ->with('success', 'Voucher berhasil ditukarkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Redeem $redeem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Redeem $redeem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Redeem $redeem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Redeem $redeem)
    {
        //
    }
}
